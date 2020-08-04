define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'dog/dog/index' + location.search,
                    add_url: 'dog/dog/add',
                    edit_url: 'dog/dog/edit',
                    del_url: 'dog/dog/del',
                    multi_url: 'dog/dog/multi',
                    table: 'dog',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'type', title: "矿机类型", searchList: {"0":"体验机","1":"每日收益","2":"到期收益"}, formatter: Table.api.formatter.flag},
                        {field: 'title', title: __('Title')},
                        {field: 'image', title: __('Image'),operate:false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'price', title:"价格", operate:'BETWEEN'},
                        {field: 'period_day', title:"周期天数"},
                        {field: 'gains', title:"利润收益"},
                        {field: 'createtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                    //    {field: 'remark', title:"备注"},
                        // {field: 'remark', title: __('Remark')},
                      //  {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'is_sell', title: __('Is_sell'), searchList: {"0":__('Is_sell 0'),"1":__('Is_sell 1')}, formatter: Table.api.formatter.toggle},



                 //       {field: 'doge', title: __('Doge'), operate:'BETWEEN'},
                    //    {field: 'rob_status', title: __('Rob_status'), searchList: {"0":__('Rob_status 0'),"1":__('Rob_status 1')}, formatter: Table.api.formatter.status},
                    //    {field: 'start_time', title: __('Start_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                    //    {field: 'end_time', title: __('End_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
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