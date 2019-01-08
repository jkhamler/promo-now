<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Promotion
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property \Carbon\Carbon $online_date
 * @property \Carbon\Carbon $promo_open_date
 * @property \Carbon\Carbon $promo_closed_date
 * @property \Carbon\Carbon $offline_date
 * @property boolean $urns_required
 * @property integer $urns_issued
 */
class Promotion extends Model
{

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
    public function promoTerms()
    {
        return $this->hasMany('App\Models\PromoTerm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function privacyTerms()
    {
        return $this->hasMany('App\Models\PrivacyTerm');
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
    public function partners()
    {
        $partners = new Collection();

        /** @var Tier $tier */
        foreach ($this->tiers as $tier) {
            /** @var TierItem $item */
            foreach ($tier->items as $item) {
                if (!$partners->contains($item->partner)) {
                    $partners->add($item->partner);
                }
            }
        }
        return $partners;
    }

    /**
     * Returns a list of partners for whom promo terms have not been set up
     *
     * @return Partner[]|Collection
     */
    public function outstandingPromoTermsPartners()
    {
        $allPartners = $this->partners();
        /** @var Collection $existingPromoTerms */
        $existingPromoTerms = $this->promoTerms;

        if ($existingPromoTerms->isEmpty()) {
            return $allPartners;
        }

        $outstandingPartners = new Collection();

        /** @var PromoTerm $existingPromoTerm */
        foreach ($existingPromoTerms as $existingPromoTerm) {
            foreach ($allPartners as $allPartner) {
                if ($existingPromoTerm->partner_id !== $allPartner->id &&
                    (!$outstandingPartners->contains($allPartner))) {
                    $outstandingPartners->add($allPartner);
                }
            }
        }

        return $outstandingPartners;

    }


}
