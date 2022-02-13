//import dashboard from './components/admin/dashboard/index.vue';
// ___________________________ Category Component ________________________________
import categoryList from './components/admin/category/categoryList.vue';
import categoryAdd from './components/admin/category/categoryAdd.vue';
import categoryEdit from './components/admin/category/categoryEdit.vue';

// ___________________________ Sub Category Component ___________________________
import SubCategoryList from './components/admin/SubCategory/SubCategoryList.vue';
import SubCategoryAdd from './components/admin/SubCategory/SubCategoryAdd.vue';
import SubCategoryEdit from './components/admin/SubCategory/SubCategoryEdit.vue';

// ___________________________ Product Component ________________________________
import productList from './components/admin/product/productList.vue';
import productAdd from './components/admin/product/productAdd.vue';
import productEdit from './components/admin/product/productEdit.vue';

export const routes = [

    {
        path: '/categoryList',
        component: categoryList
    },

    {
        path: '/categoryAdd',
        component: categoryAdd
    },
    {
        path: '/editCategory/:categoryId',
        component: categoryEdit
    },

    //_______________________ Sub Category Route ___________________
    {
        path: '/SubCategoryList',
        component: SubCategoryList
    },

    {
        path: '/SubCategoryAdd',
        component: SubCategoryAdd
    },
    {
        path: '/SubCategoryEdit/:SubCategoryId',
        component: SubCategoryEdit
    },

    //_______________________ Product Route ___________________
    {
        path: '/productList',
        component: productList
    },

    {
        path: '/productAdd',
        component: productAdd
    },
    {
        path: '/productEdit/:productId',
        component: productEdit
    },




]