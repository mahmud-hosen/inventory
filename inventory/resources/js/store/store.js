import Axios from "axios"

export default {
    //  Step: 9
    state: {
        category: [],
        SubCategory: [],
        product: [],
        customer:[]

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
        
    }
}
