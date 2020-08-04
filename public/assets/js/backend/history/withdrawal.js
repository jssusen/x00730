define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'history/withdrawal/index' + location.search,
                    add_url: 'history/withdrawal/add',
                    edit_url: 'history/withdrawal/edit',
                    del_url: 'history/withdrawal/del',
                    multi_url: 'history/withdrawal/multi',
                    table: 'withdrawal',
                }
            });

            var table = $("#table");

            table.on('load-success.bs.table', function (e, data) {
                //这里可以获取从服务端获取的JSON数据

                //这里我们手动设置底部的值
                $("#notReviewed").text(data.extend.notReviewed);
                $("#agreed").text(data.extend.agreed);
                $("#refuse").text(data.extend.refuse);
            });


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

                        {field: 'type', title: __('Type'), searchList: {"0":__('Type 0'),"1":__('Type 1')}, formatter: Table.api.formatter.normal},
                        {field: 'uid', title: __('Uid'),formatter:function(value, row, index){
                                if(row.member){
                                    return row.member.user_name
                                }
                                return  "无"
                            }},
                        {field: 'money', title: __('Money'), operate:'BETWEEN'},
                        {field: 'procedures_money', title: __('Procedures_money'), operate:'BETWEEN'},
                        {field: 'really_money', title: __('Really_money'), operate:'BETWEEN'},
                        {field: 'remark', title: __('Remark')},
                        {field: 'money_position', title: __('Money_position')},
                        {field: 'createtime', title: "创建时间",operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: "更改时间",operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'is_pay', title: __('Is_pay'), searchList: {"0":__('Is_pay 0'),"1":__('Is_pay 1'),"2":__('Is_pay 2')}, formatter: Table.api.formatter.flag},
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