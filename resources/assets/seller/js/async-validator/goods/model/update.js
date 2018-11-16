export const Validator = (data) => {
    return {
        name: [
            {required: true, type: 'string', message: '名称必须填写', trigger: 'blur'},
            {type: 'string', min: 2, max: 20, message: '名称必须在 2 到 20 个字符之间', trigger: 'blur'}
        ],
        specs: [
            {type: 'array', message: '模型规格格式不正确', trigger: 'blur'},
        ]
    }
}