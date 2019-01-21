<!-- Stored in resources/views/home.blade.php -->

@extends('master')

@section('title', 'PromoNow')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="container-fluid">


        <div>
            <h3>
                Welcome to PromoNow!
            </h3>

            <p>
                The easiest one-stop solution for configuring your promotional campaigns.
            </p>

        </div>

        <br/>

        <div class="row">

            <div class="row">
                <div class="col-md-6">
                    <div class="todolist not-done border">
                        <h2>Todo</h2>
                        <input type="text" class="form-control add-todo" placeholder="Add todo">
                        <button id="checkAll" class="btn btn-success">Mark all as done</button>

                        <hr>
                        <ul id="sortable" class="list-unstyled">
                            <li class="ui-state-default">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""/>Register Users</label>
                                </div>
                            </li>
                            <li class="ui-state-default">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""/>Register Suppliers</label>
                                </div>
                            </li>
                            <li class="ui-state-default">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""/>Create First Promo Campaign</label>
                                </div>
                            </li>
                        </ul>
                        <div class="todo-footer">
                            <strong><span class="count-todos"></span></strong> Items Left
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="todolist border">
                        <h2>Already Done</h2>
                        <ul id="done-items" class="list-unstyled">
                            <li>Some item
                                <button class="remove-item btn btn-default btn-xs pull-right"><span
                                            class="glyphicon glyphicon-remove"></span></button>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>


    </div>

    <script type="text/javascript">
        $("#sortable").sortable();
        $("#sortable").disableSelection();

        countTodos();

        // all done btn
        $("#checkAll").click(function () {
            AllDone();
        });

        //create todo
        $('.add-todo').on('keypress', function (e) {
            e.preventDefault
            if (e.which == 13) {
                if ($(this).val() != '') {
                    var todo = $(this).val();
                    createTodo(todo);
                    countTodos();
                } else {
                    // some validation
                }
            }
        });
        // mark task as done
        $('.todolist').on('change', '#sortable li input[type="checkbox"]', function () {
            if ($(this).prop('checked')) {
                var doneItem = $(this).parent().parent().find('label').text();
                $(this).parent().parent().parent().addClass('remove');
                done(doneItem);
                countTodos();
            }
        });

        //delete done task from "already done"
        $('.todolist').on('click', '.remove-item', function () {
            removeItem(this);
        });

        // count tasks
        function countTodos() {
            var count = $("#sortable li").length;
            $('.count-todos').html(count);
        }

        //create task
        function createTodo(text) {
            var markup = '<li class="ui-state-default"><div class="checkbox"><label><input type="checkbox" value="" />' + text + '</label></div></li>';
            $('#sortable').append(markup);
            $('.add-todo').val('');
        }

        //mark task as done
        function done(doneItem) {
            var done = doneItem;
            var markup = '<li>' + done + '<button class="btn btn-default btn-xs pull-right  remove-item"><span class="glyphicon glyphicon-remove"></span></button></li>';
            $('#done-items').append(markup);
            $('.remove').remove();
        }

        //mark all tasks as done
        function AllDone() {
            var myArray = [];

            $('#sortable li').each(function () {
                myArray.push($(this).text());
            });

            // add to done
            for (i = 0; i < myArray.length; i++) {
                $('#done-items').append('<li>' + myArray[i] + '<button class="btn btn-default btn-xs pull-right  remove-item"><span class="glyphicon glyphicon-remove"></span></button></li>');
            }

            // myArray
            $('#sortable li').remove();
            countTodos();
        }

        //remove done task from list
        function removeItem(element) {
            $(element).parent().remove();
        }
    </script>

@endsection