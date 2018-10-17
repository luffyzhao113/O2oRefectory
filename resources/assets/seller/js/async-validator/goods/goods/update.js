export const Validator = (data) => {
    return {
        name: [
            {required: true, type: 'string', message: '名称必须填写', trigger: 'blur'},
            {type: 'string', min: 2, max: 20, message: '名称必须在 2 到 20 个字符之间', trigger: 'blur'}
        ],
        type: [
            {required: true, type: 'number', message: '类型必须填写', trigger: 'change'},
        ],
        input: [
            {required: true, type: 'string', message: '输入框必须填写', trigger: 'change'},
        ]
    }
}