define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'order/match/index' + location.search,
                    // add_url: 'order/match/add',
                    // edit_url: 'order/match/edit',
                    del_url: 'order/match/del',
                    multi_url: 'order/match/multi',
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

                      //  {field: 'order_id', title: __('Order_id')},

                        {field: 'uid', title: "用户名",formatter:function(value, row, index){
                                if (row.user){
                                    return row.user.user_name
                                }
                                return  "无";
                            } },
                        {field: 'type', title: "矿机类型", searchList: {"0":"体验机","1":"每日收益","2":"到期收益"}, formatter: Table.api.formatter.flag},


                        {field: 'order_id', title:"订单号"},
                        {field: 'dog_name', title:"产品名称"},
                        // {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},

                        {field: 'money', title: __('Money'), operate:'BETWEEN'},

                        {field: 'period_day', title:"周期", operate:'BETWEEN'},
                        {field: 'move_day', title:"运行天数", operate:'BETWEEN'},
                        {field: 'return_money', title:"已返还金额", operate:'BETWEEN'},
                        {field: 'return_money_day', title:"每天返还", operate:'BETWEEN'},
                        {field: 'return_money_all', title:"总返还金额", operate:'BETWEEN'},


                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},



                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},




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