define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'history/history/index' + location.search,
                    add_url: 'history/history/add',
                    edit_url: 'history/history/edit',
                    del_url: 'history/history/del',
                    multi_url: 'history/history/multi',
                    table: 'history',
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


            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                    //    {field: 'id', title: __('Id')},
                        {field: 'uid', title: "用户名",formatter:function(value, row, index){
                                if(row.member){
                                    return row.member.user_name
                                }
                                return  "无"
                            }},
                        {field: 'money', title: __('Money'), operate:'BETWEEN'},
                      //  {field: 'type', title: __('Type')},
                     {field: 'remark', title: "备注",operate:false, },
                   //     {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'createtime', title: "创建时间",operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                  //      {field: 'option', title: __('Option')},
                  //      {field: 'source', title: __('Source')},
                //        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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