define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'member/member_group/index' + location.search,
                    add_url: 'member/member_group/add',
                    edit_url: 'member/member_group/edit',
                    del_url: 'member/member_group/del',
                    multi_url: 'member/member_group/multi',
                    table: 'member_group',
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
                        {field: 'title', title: __('Title')},
                        {field: 'iconimage', title: __('Iconimage'), events: Table.api.events.image, formatter: Table.api.formatter.image},

                        // {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')},  formatter: Table.api.formatter.toggle},
                        {field: 'day_rob_number', title: __('Day_rob_number')},
                        {field: 'commission', title: __('Commission')},
                        {field: 'share_bonus', title: __('Share_bonus')},
                        {field: 'team_bonus', title: __('Team_bonus')},
                        {field: 'team_layer', title: __('Team_layer')},
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