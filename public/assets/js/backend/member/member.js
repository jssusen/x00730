define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'member/member/index' + location.search,
                    add_url: 'member/member/add',
                    edit_url: 'member/member/edit',
                    del_url: 'member/member/del',
                    multi_url: 'member/member/multi',
                    table: 'member',
                }
            });



    var table = $("#table");

            table.on('post-common-search.bs.table', function (event, table) {
                var form = $("form", table.$commonsearch);
                $("input[name='member_group_id']", form).addClass("selectpage").data("source", "member.Member_Group/index").data("primaryKey", "id").data("field", "title").data("orderBy", "id desc");
                Form.events.cxselect(form);
                Form.events.selectpage(form);
            });

            table.on('post-common-search.bs.table', function (event, table) {
                var form = $("form", table.$commonsearch);
                $("input[name='re_id']", form).addClass("selectpage").data("source", "member.member/index").data("primaryKey", "id").data("field", "user_name").data("orderBy", "id desc");
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
                        {field: 'user_name', title: '用户名'},
                        {field: 'mobile', title: __('Mobile')},
                        {field: 'realname', title: __('Realname')},
                        {field: 'idcard', title: __('Idcard')},
                        {field: 'avatarimage',  operate:false, title: __('Avatarimage'), events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'sex', title: __('Sex'), searchList: {"0":__('Sex 0'),"1":__('Sex 1'),"2":__('Sex 2')}, formatter: Table.api.formatter.normal},
                        // {field: 'email', title: __('Email')},
                        {field: 'member_group_id', title: __('Member_group_id') ,formatter:function(value, row, index){
                                if (row.member_group){
                                    return row.member_group.title
                                }
                                return  "无";

                            }   },
                        {field: 're_id', title: __('Re_id'),formatter:function(value, row, index){
                                if (row.user){
                                    return row.user.user_name
                                }
                                return  '无'
                            } },
                        // {field: 'login_time', title: __('Login_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'login_ip', title: __('Login_ip')},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.toggle},
                   //     {field: 'robber', title: __('Robber'), searchList: {"0":__('Robber 0'),"1":__('Robber 1')}, formatter: Table.api.formatter.toggle},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'alipay', title: __('Alipay')},
                        // {field: 'wia', title: __('Wia'), operate:'BETWEEN'},
                        // {field: 'doge', title: __('Doge'), operate:'BETWEEN'},
                        // {field: 'balance', title: __('Balance'), operate:'BETWEEN'},
                        {field: 'integrals', title: "可用余额", operate:'BETWEEN'},
                        {field: 'itc_income', title: "矿机收益", operate:'BETWEEN'},
                        {field: 'share_income', title: __('Share_income'), operate:'BETWEEN'},
                        // {field: 'service_integrals', title: __('Service_integrals'), operate:'BETWEEN'},
                        // {field: 'invest_integrals', title: __('Invest_integrals'), operate:'BETWEEN'},

                        // {field: 're_level', title: __('Re_level')},
                        // {field: 'super_power', title: __('Super_power')},
                        // {field: 'self_achievement', title: __('Self_achievement'), operate:'BETWEEN'},
                        // {field: 'team_achievement', title: __('Team_achievement'), operate:'BETWEEN'},
                        // {field: 'share_achievement', title: __('Share_achievement'), operate:'BETWEEN'},
                        {field: 'share_code', title: __('Share_code')},
                        // {field: 'flow', title: __('Flow'), operate:'BETWEEN'},
                        // {field: 'total_income', title: __('Total_income'), operate:'BETWEEN'},
                        // {field: 'online_time', title: __('Online_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'first_sell', title: __('First_sell')},
                        // {field: 'effective', title: __('Effective')},
                        {field: 'is_valid', title: __('is_valid'), searchList: {"0":__('is_valid 0'),"1":__('is_valid 1')}, formatter: Table.api.formatter.label},

                        {field: 'operate', title: __('Operate'), table: table,
                            events: Table.api.events.operate,
                            formatter: Table.api.formatter.operate,
                            buttons: [
                                {
                                    name: 'detail',
                                    title: __('充值'),
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    icon: 'fa fa-money',
                                    url: 'member/member/recharge',
                                    callback: function (data) {
                                        // Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                    }
                                },
                                // {
                                //     name: 'createMatch',
                                //     title: __('出场'),
                                //     classname: 'btn btn-xs btn-primary btn-dialog',
                                //     icon: 'fa fa-arrow-circle-up',
                                //     url: 'member/member/create',
                                //     callback: function (data) {
                                //         // Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                //     }
                                // },



                            ],
                        }
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
        recharge:function(){
            Form.api.bindevent($("form[role=form]"), function(data, ret){
                //这里是表单提交处理成功后的回调函数，接收来自php的返回数据
                Fast.api.close(data);//这里是重点
                Toastr.success("成功");//这个可有可无
            }, function(data, ret){
                Toastr.error("失败");
            });
        },
         create:function(){
             Form.api.bindevent($("form[role=form]"), function(data, ret){
                 //这里是表单提交处理成功后的回调函数，接收来自php的返回数据
                 Fast.api.close(data);//这里是重点
                 Toastr.success("成功");//这个可有可无
             }, function(data, ret){
                 Toastr.error("失败");
             });


        },



        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});