import {$http} from '../../../plugins/ajax/index'

export const Validator = (data) => {

    let sellerEmail = (rule, value, callback) => {
        $http.get('validator/seller-email', {params: {
                email: value,
                except: data.formUpdate.admin.id
            }}).then((res) => {
            if(res.data.data === null){
                callback()
            }else{
                callback(new Error('登录邮箱被占用'))
            }
        }).catch(() => {
            callback(new Error('系统错误'))
        })
    }

    return {
        name: [
            {required: true, type: 'string', message: '店铺名称不能为空', trigger: 'blur'},
            {type: 'string', min: 2, max: 20, message: '店铺名称必须在 2 到 20 个字符之间', trigger: 'blur'}
        ],
        status: [
            {required: true, type: 'number', message: '店铺状态不能为空', trigger: 'change'}
        ],
        "admin.email": [
            {required: true, type: 'email', message: '登录账号不能为空', trigger: 'blur'},
            {validator: sellerEmail}
        ],
        "admin.name": [
            {required: true, type: 'string', message: '管理员姓名不能为空', trigger: 'blur'}
        ],
        "admin.password": [
            {type: 'string', min: 6, max: 20, message: '登录密码必须在 6 到 20 个字符之间', trigger: 'blur'}
        ],
        "admin.password_confirmation": [
            {
                validator(rule, value, callback, source, options) {
                    if(data.formUpdate.admin.password !== value){
                        callback(new Error('两次输入密码不正确！'));
                    }else{
                        callback();
                    }
                }, trigger: 'blur'
            }
        ]
    }
}