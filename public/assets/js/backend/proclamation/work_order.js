define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'proclamation/work_order/index' + location.search,
                    add_url: 'proclamation/work_order/add',
                    edit_url: 'proclamation/work_order/edit',
                    del_url: 'proclamation/work_order/del',
                    multi_url: 'proclamation/work_order/multi',
                    table: 'work_order',
                }
            });

            var table = $("#table");
            table.on('post-common-search.bs.table', function (event, table) {
                var form = $("form", table.$commonsearch);
                $("input[name='uid']", form).addClass("selectpage").data("source", "member.member/index").data("primaryKey", "id").data("field", "user_name").data("orderBy", "id desc");
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
                        {field: 'uid', title: "用户名称",formatter:function(value, row, index){
                            if (row.member_name){
                                return  row.member_name.user_name
                            }
                              return  无
                            }},
                        {field: 'content', title: __('Content'),operate:false,formatter:function (value, row, index) {
                                return    '<p style="width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">'+value+'</p>'
                            }},
                        {field: 'reply_content', title:"工单回复",operate:false,formatter:function (value, row, index) {
                                return    '<p style="width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">'+value+'</p>'
                            }},
                        {field: 'createtime', title: '创建时间', operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: '更新时间', operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},
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