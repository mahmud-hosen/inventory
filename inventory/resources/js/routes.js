import dashboard from './components/admin/dashboard/index.vue';
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
// ___________________________ POS Component ________________________________
import pos from './components/admin/pos/pos.vue';

// ___________________________ Customer Component ________________________________
import customerList from './components/admin/customer/customerList.vue';
import customerAdd from './components/admin/customer/customerAdd.vue';
import customerEdit from './components/admin/customer/customerEdit.vue';

// ___________________________ Invoice Component ________________________________
import createInvoice from './components/admin/pos/invoice.vue';

// ___________________________ Order Component ________________________________
import orderList from './components/admin/order/orderList.vue';
import orderDetails from './components/admin/order/orderDetails.vue';

// ___________________________ Employee Component ________________________________
import employeeAdd from './components/admin/Employee/employeeAdd.vue';
import employeeEdit from './components/admin/Employee/employeeEdit.vue';
import employeeList from './components/admin/Employee/employeeList.vue';

// ___________________________ Salary Component ________________________________
import salaryAdd from './components/admin/Salary/salaryAdd.vue';
import salaryList from './components/admin/Salary/salaryList.vue';
import salaryEdit from './components/admin/Salary/salaryEdit.vue';

// ___________________________ Attendence Component ________________________________
import takeAttendence from './components/admin/attendence/takeAttendence.vue';
import viewAttendence from './components/admin/attendence/viewAttendence.vue';
import editAttendence from './components/admin/attendence/editAttendence.vue';

// ___________________________ Attendence Component ________________________________
import stockAdd from './components/admin/stock/stockAdd.vue';
import stockList from './components/admin/stock/stockList.vue';
import stockEdit from './components/admin/stock/stockEdit.vue';


export const routes = [
    { path: '/', component: dashboard },


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

    //________________________________POS Route ______________
    {
        path: '/pos',
        component: pos
    },
    //________________________________ Customer Route ______________
    { path: '/customerList', component: customerList },
    { path: '/customerAdd', component: customerAdd },
    { path: '/customerEdit/:customerId', component: customerEdit },

    //________________________________ Invoice Route ______________
    { path: '/createInvoice/:customerId', component: createInvoice },

    //________________________________ Order Route ______________
    { path: '/orderList', component: orderList },
    { path: '/orderDetails/:orderId', component: orderDetails },
    //________________________________ Employee Route ______________
    { path: '/employeeAdd', component: employeeAdd },
    { path: '/employeeList', component: employeeList },
    { path: '/employeeEdit/:employeeId', component: employeeEdit },
    //________________________________ Salary Route ______________
    { path: '/salaryAdd', component: salaryAdd },
    { path: '/salaryList', component: salaryList },
    { path: '/salaryEdit/:salaryId', component: salaryEdit },

    //________________________________ Attd Route ______________
    { path: '/takeAttendence', component: takeAttendence },
    { path: '/viewAttendence', component: viewAttendence },
    { path: '/editAttendence/:attendenceId', component: editAttendence },

    //________________________________ Attd Route ______________
    { path: '/stockAdd', component: stockAdd },
    { path: '/stockList', component: stockList },
    { path: '/stockEdit/:stockId', component: stockEdit },








]