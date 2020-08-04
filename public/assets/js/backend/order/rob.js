define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'order/rob/index' + location.search,
                    add_url: 'order/rob/add',
                    edit_url: 'order/rob/edit',
                    del_url: 'order/rob/del',
                    multi_url: 'order/rob/multi',
                    table: 'match',
                }
            });

            var table = $("#table");


            table.on('post-common-search.bs.table', function (event, table) {
                var form = $("form", table.$commonsearch);
                $("input[name='uid']", form).addClass("selectpage")
                    .data("source", "member.Member/index")
                    .data("primaryKey", "id")
                    .data("field", "user_name")
                    .data("orderBy", "id desc");
                Form.events.cxselect(form);
                Form.events.selectpage(form);
            });

            table.on('post-common-search.bs.table', function (event, table) {
                var form = $("form", table.$commonsearch);
                $("input[name='dog_id']", form).addClass("selectpage")
                    .data("source", "dog.Dog/index")
                    .data("primaryKey", "id")
                    .data("field", "title")
                    .data("orderBy", "id desc");
                Form.events.cxselect(form);
                Form.events.selectpage(form);
            });


            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'order_id', title: __('Order_id')},
                        {field: 'uid', title: "用户名",formatter:function(value, row, index){
                            if (row.member){
                                return row.member.user_name
                            }
                            return  "无";
                           } },
                        {field: 'dog_id', title:"产品名称",formatter:function(value, row, index){
                                if (row.dog){
                                    return row.dog.title
                                }
                                return  "无";
                            } },
                        //{field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},

                       // {field: 'match_time', title: __('Match_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'money', title: __('Money'), operate:'BETWEEN'},
                      //  {field: 'unmatched', title: __('Unmatched'), operate:'BETWEEN'},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},
                        {field: 'order_type', title: __('Order_type'), searchList: {"0":__('Order_type 0'),"1":__('Order_type 1')}, formatter: Table.api.formatter.normal},
                        {field: 'match_status', title: __('Match_status'), searchList: {"0":__('Match_status 0'),"1":__('Match_status 1'),"2":__('Match_status 2')}, formatter: Table.api.formatter.status},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},

                       // {field: 'pay_status', title: __('Pay_status')},
                        //{field: 'is_lock', title: __('Is_lock'), searchList: {"0":__('Is_lock 0'),"1":__('Is_lock 1')}, formatter: Table.api.formatter.normal},
                       // {field: 'finish_time', title: __('Finish_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                       // {field: 'source', title: __('Source')},
                       // {field: 'plan_time', title: __('Plan_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                       // {field: 'first_sell', title: __('First_sell')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});