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
        cash: [],
        totalCash: [],
        expenseList:[]


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
        
        cashListFromStore(state) {
            return state.cash
        },
        totalCashFromStore(state) {
            return state.totalCash
        },
        expenseListFromStore(state) {
            return state.expenseList
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
        CashListSaveInStore(context) {
            Axios.get('/cashList').then((response) => {
                context.commit('AllCashList', response.data.cashList)
            })
        },
        TotalCashSaveInStore(context) {
            Axios.get('/totalCash').then((response) => {
                context.commit('TotalCash', response.data.total_cash)
            })
        },
        
        ExpenseListSaveInStore(context) {
            Axios.get('/expenseList').then((response) => {
                context.commit('ExpenseList', response.data.expenseList)
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
        AllCashList(state, responseData) {
            return state.cash = responseData
        },
        TotalCash(state, responseData) {
            return state.totalCash = responseData
        },
        ExpenseList(state, responseData) {
            return state.expenseList = responseData
        },

        

        






    }
}
