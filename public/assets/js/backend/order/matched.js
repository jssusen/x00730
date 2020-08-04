define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'order/matched/index' + location.search,
                    add_url: 'order/matched/add',
                    edit_url: 'order/matched/edit',
                    del_url: 'order/matched/del',
                    multi_url: 'order/matched/multi',
                    table: 'matched',
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
                $("input[name='bid']", form).addClass("selectpage")
                    .data("source", "member.Member/index")
                    .data("primaryKey", "id")
                    .data("field", "user_name")
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
                        {field: 'money', title: __('Money'), operate:'BETWEEN'},
                        {field: 'in_order_id', title: __('In_order_id')},
                        {field: 'uid', title: __('Uid'),formatter:function(value, row, index){
                                if (row.user){
                                    return row.user.user_name
                                }
                                return  "无";
                            }},
                        {field: 'out_order_id', title: __('Out_order_id')},
                        {field: 'bid', title: __('Bid'),formatter:function(value, row, index){
                                if (row.users){
                                    return row.users.user_name
                                }
                                return  "无";
                            }},
                    //    {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                  //      {field: 'pay_time', title: __('Pay_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                  //      {field: 'receipt_time', title: __('Receipt_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'pay_status', title: __('Pay_status')},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},
                   //     {field: 'is_check', title: __('Is_check')},
                   //     {field: 'complaint_time', title: __('Complaint_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                    //    {field: 'complaint_time_buy', title: __('Complaint_time_buy')},
                    //    {field: 'complaint_buy', title: __('Complaint_buy')},
                    //    {field: 'complaint_time_sell', title: __('Complaint_time_sell')},
                  //      {field: 'complaint_sell', title: __('Complaint_sell')},
                    //    {field: 'source', title: __('Source')},
                    //    {field: 'grow_day', title: __('Grow_day')},
                   //    {field: 'have_pay_day', title: __('Have_pay_day')},
                    //    {field: 'gains', title: __('Gains'), operate:'BETWEEN'},
                      //  {field: 'income', title: __('Income'), operate:'BETWEEN'},
                      //  {field: 'wia', title: __('Wia'), operate:'BETWEEN'},
                     //   {field: 'doge', title: __('Doge'), operate:'BETWEEN'},
                     //   {field: 'grow_status', title: __('Grow_status')},
                      //  {field: 'dog_id', title: __('Dog_id')},
                     //   {field: 'end_grow_time', title: __('End_grow_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                      //  {field: 'bonus_time', title: __('Bonus_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
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