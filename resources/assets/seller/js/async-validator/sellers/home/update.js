import {$http} from '../../../plugins/ajax/index'

export const Validator = (data) => {
    let domain = (rule, value, callback) => {
        if (value === 'admin' || value === 'administration' || value === 'www') {
            callback(new Error('二级域名不能是 admin | administration | www'))
        }

        $http.get('validator/seller', {params: {
                domain: value,
                except: data.data.id
            }}).then((res) => {
            if(res.data.data === null){
                callback()
            }else{
                callback(new Error('二级域名被占用'))
            }
        }).catch(() => {
            callback(new Error('系统错误'))
        })
    };

    return {
        name: [
            {required: true, type: 'string', message: '店铺名称不能为空', trigger: 'blur'},
            {type: 'string', min: 2, max: 20, message: '店铺名称必须在 2 到 20 个字符之间', trigger: 'blur'}
        ],
        domain: [
            {required: true, type: 'string', message: '二级域名不能为空', trigger: 'blur'},
            {type: 'string', min: 2, max: 10, message: '二级域名必须在 2 到 10 个字符之间', trigger: 'blur'},
            {validator: domain, trigger: 'blur'},
        ],
        status: [
            {required: true, type: 'number', message: '店铺状态不能为空', trigger: 'change'}
        ]
    }
}