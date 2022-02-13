import Axios from "axios"

export default {
    //  Step: 9
    state: {
        category: [],
        SubCategory: [],
        product: []

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
    }
}
