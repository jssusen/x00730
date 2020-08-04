define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'dog/apply/index' + location.search,
                    add_url: 'dog/apply/add',
                    edit_url: 'dog/apply/edit',
                    del_url: 'dog/apply/del',
                    multi_url: 'dog/apply/multi',
                    table: 'apply',
                }
            });

            var table = $("#table");
            table.on('post-common-search.bs.table', function (event, table) {
                var form = $("form", table.$commonsearch);
                $("input[name='uid']", form).addClass("selectpage").data("source", "member.Member/index").data("primaryKey", "id").data("field", "user_name").data("orderBy", "id desc");
                Form.events.cxselect(form);
                Form.events.selectpage(form);
            });

            table.on('post-common-search.bs.table', function (event, table) {
                var form = $("form", table.$commonsearch);
                $("input[name='dog_id']", form).addClass("selectpage").data("source", "dog.Dog/index").data("primaryKey", "id").data("field", "title").data("orderBy", "id desc");
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
                        {field: 'uid', title: __('Uid') ,formatter:function(value, row, index){
                            if(row.member){
                                return row.member.user_name
                            }
                            return  "无"

                            }},
                        {field: 'dog_id', title: __('Dog_id'),formatter:function(value, row, index){
                                if(row.dog){
                                    return row.dog.title
                                }
                                return  "无"}},
                        {field: 'createtime', title: '预约时间', operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'apply_fee', title: __('Apply_fee'), operate:'BETWEEN'},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},
                        // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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