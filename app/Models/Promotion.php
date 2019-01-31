<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Promotion
 *
 * @property integer $id
 * @property string $name
 * @property string $reference
 * @property string $url
 * @property string $description
 * @property \Carbon\Carbon $online_date
 * @property \Carbon\Carbon $promo_open_date
 * @property \Carbon\Carbon $promo_closed_date
 * @property \Carbon\Carbon $offline_date
 * @property boolean $urns_required
 * @property integer $urns_issued
 */
class Promotion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'online_date',
        'promo_open_date',
        'promo_closed_date',
        'offline_date',
    ];


    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'reference',
        'url',
        'description',
        'online_date',
        'promo_open_date',
        'promo_closed_date',
        'offline_date',
        'urns_required',
        'urns_issued',
    ];

    /**
     * @param Carbon|null $date
     * @return null|string
     */
    public static function dateFieldFormat(Carbon $date = null)
    {
        return $date ? $date->format('Y-m-d') . 'T' . $date->format('H:i') : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tiers()
    {
        return $this->hasMany('App\Models\Tier');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mechanics()
    {
        return $this->hasMany('App\Models\Mechanic');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function urnSpecifications()
    {
        return $this->hasMany('App\Models\UrnSpecification');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faqGroups()
    {
        return $this->hasMany('App\Models\FAQGroup');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promoTerms()
    {
        $promoTerms = $this->hasMany('App\Models\PromoTerm')->orderBy('version', 'desc');

        return $promoTerms;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entrants()
    {
        $entrants = $this->hasMany('App\Models\Entrant')->orderBy('created_at', 'desc');

        return $entrants;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promotionPartners()
    {
        return $this->hasMany('App\Models\PromotionPartner');
    }


    /**
     * @return int|null
     */
    public function getMostRecentPromoTermVersion()
    {

        /** @var Collection $promoTerms */
        $promoTerms = $this->promoTerms;

        $mostRecentPromoTerm = $promoTerms->first();

        return ($mostRecentPromoTerm instanceof PromoTerm) ? $mostRecentPromoTerm->version : null;
    }

    /**
     * @param $partnerId
     * @return int
     */
    public function getMostRecentPrivacyTermVersion($partnerId)
    {

        $version = DB::table('privacy_terms AS pt')
            ->select('pt.version')
            ->where('pt.promotion_id', $this->id)
            ->where('pt.partner_id', $partnerId)
            ->orderBy('pt.version', 'desc')
            ->first();

        return ($version instanceof \stdClass) ? $version->version : null;

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function privacyTerms()
    {
        return $this->hasMany('App\Models\PrivacyTerm')->orderBy('version', 'desc');
    }

    /**
     * @return Collection
     */
    public function getAllPossibleTierItems()
    {
        $tierItems = new Collection();

        /** @var Tier $tier */
        foreach ($this->tiers as $tier) {

            $tierItems = $tierItems->merge($tier->items);
        }
        return $tierItems;

    }

    /**
     * @return Collection|Partner[]
     */
    public function allPartners()
    {
        $partners = new Collection();

        /** @var PromotionPartner $promotionPartner */
        foreach ($this->promotionPartners as $promotionPartner) {
            if (!$partners->contains($promotionPartner->partner)) {
                $partners->add($promotionPartner->partner);
            }
        }
        return $partners;
    }

    /**
     * @return Collection|Urn[]
     */
    public function urns()
    {
        $urns = new Collection();

        /** @var UrnSpecification $urnSpecification */
        foreach ($this->urnSpecifications as $urnSpecification) {

            /** @var UrnBatch $urnBatch */
            foreach ($urnSpecification->urnBatches as $urnBatch) {

                foreach ($urnBatch->urns as $urn) {

                    if (!$urns->contains($urn)) {
                        $urns->add($urn);
                    }
                }
            }
        }
        return $urns;
    }

    /**
     * Returns a list of partners for whom privacy terms have not been set up
     *
     * @return Partner[]|Collection
     */
    public function outstandingPrivacyTermsPartners()
    {
        $allPartners = $this->allPartners();

        if ($this->privacyTerms->isEmpty()) {
            return $allPartners;
        }

        $existingPrivacyTermsPartners = $this->existingPrivacyTermsPartners();

        $outstandingPartners = new Collection();

        foreach ($allPartners as $allPartner) {
            if(!$existingPrivacyTermsPartners->contains($allPartner)){
                $outstandingPartners->add($allPartner);
            }
        }

        return $outstandingPartners;
    }

    /**
     * @return Collection
     */
    public function existingPrivacyTermsPartners()
    {
        $existingPrivacyPartners = new Collection();

        /** @var PrivacyTerm $privacyTerm */
        foreach ($this->privacyTerms as $privacyTerm) {
            if (!$existingPrivacyPartners->contains($privacyTerm->partner)) {
                $existingPrivacyPartners->add($privacyTerm->partner);
            }
        }
        return $existingPrivacyPartners;
    }


}
