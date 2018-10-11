export default {
    data() {
        return {
            component: {
                current: '',
                data: {}
            }
        }
    },
    methods: {
        showComponent(type, data) {
            this.component.current = type
            this.component.data = data
        },
        hideComponent() {
            this.component.current = ''
            this.component.data = {}
            this.search()
        },
    }
}