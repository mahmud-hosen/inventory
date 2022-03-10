import Axios from "axios"

export default {
    //  Step: 9
    state: {
        category: [],
        SubCategory: [],
        product: [],
        customer: [],
        order: [],
        employee: [],
        salary: [],


    },

    //  Step: 11
    getters: {
        categoryListFromStore(state) {
            return state.category
        },
        SubCategoryListFromStore(state) {
            return state.SubCategory
        },
        productListFromStore(state) {
            return state.product
        },
        customerListFromStore(state) {
            return state.customer
        },
        orderListFromStore(state) {
            return state.order
        },
        employeeListFromStore(state) {
            return state.employee
        },
        salaryListFromStore(state) {
            return state.salary
        },






    },

    //  Step: 5
    actions: {

        CategoryListSaveInStore(context) {
            Axios.get('/CategoryList').then((response) => {
                context.commit('categoryListItem', response.data.categoryList)
            })
        },
        SubCategoryListSaveInStore(context) {
            Axios.get('/SubCategoryList').then((response) => {
                context.commit('SubCategoryListItem', response.data.SubCategoryList)
            })
        },
        productListSaveInStore(context) {
            Axios.get('/productList').then((response) => {
                context.commit('AllProductListItem', response.data.AllProductList)
            })
        },

        customerListSaveInStore(context) {
            Axios.get('/customerList').then((response) => {
                context.commit('AllCustomerList', response.data.AllCustomerList)
            })
        },
        OrderListSaveInStore(context) {
            Axios.get('/orderList').then((response) => {
                context.commit('AllOrderList', response.data.orderList)
            })
        },
        employeeListSaveInStore(context) {
            Axios.get('/employeeList').then((response) => {
                context.commit('AllEmployeeList', response.data.EmployeeList)
            })
        },
        salaryListSaveInStore(context) {
            Axios.get('/salaryList').then((response) => {
                context.commit('AllSalaryList', response.data.salaryList)
            })
        },




    },

    //  Step: 8
    mutations: {
        categoryListItem(state, responseData) {
            return state.category = responseData
        },
        SubCategoryListItem(state, responseData) {
            return state.SubCategory = responseData
        },
        AllProductListItem(state, responseData) {
            return state.product = responseData
        },
        AllCustomerList(state, responseData) {
            return state.customer = responseData
        },
        AllOrderList(state, responseData) {
            return state.order = responseData
        },
        AllEmployeeList(state, responseData) {
            return state.employee = responseData
        },
        AllSalaryList(state, responseData) {
            return state.salary = responseData
        },






    }
}
