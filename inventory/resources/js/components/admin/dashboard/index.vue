<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <!-- <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard v2</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v2</li>
              </ol>
            </div> -->
          </div>
        </div>
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"
                  ><i class="fas fa-list"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Category </span>
                  <span class="info-box-number">{{categoryCount}}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"
                  ><i class="fas fa-tag"></i
                ></span>

                <div class="info-box-content">
                  <span class="info-box-text">Sub Category</span>
                  <span class="info-box-number">{{subCategoryCount}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"
                  ><i class="fas fa-shopping-cart"></i
                ></span>

                <div class="info-box-content">
                  <span class="info-box-text">Product</span>
                  <span class="info-box-number">{{productCount}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"
                  ><i class="fas fa-user-alt"></i
                ></span>

                <div class="info-box-content">
                  <span class="info-box-text">Employee</span>
                  <span class="info-box-number">{{employeeCount}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>

          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"
                  ><i class="fas fa-dollar-sign"></i
                ></span>

                <div class="info-box-content">
                  <span class="info-box-text">Today Cash</span>
                  <span class="info-box-number">{{todayCash}}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"
                  ><i class="fas fa-money-check-alt"></i
                ></span>

                <div class="info-box-content">
                  <span class="info-box-text">Today Expense</span>
                  <span class="info-box-number">{{todayExpense}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"
                  ><i class="fas fa-cart-plus"></i
                ></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pending Order</span>
                  <span class="info-box-number">{{orderStatus}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"
                  ><i class="fas fa-users"></i
                ></span>

                <div class="info-box-content">
                  <span class="info-box-text">Customer </span>
                  <span class="info-box-number">{{customerCount}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          

          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">SubCategory wise Product</h5>

                  <div class="card-tools">
                    <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="collapse"
                    >
                      <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">
                      <button
                        type="button"
                        class="btn btn-tool dropdown-toggle"
                        data-toggle="dropdown"
                      >
                        <i class="fas fa-wrench"></i>
                      </button>
                      <div
                        class="dropdown-menu dropdown-menu-right"
                        role="menu"
                      >
                        <a href="#" class="dropdown-item">Action</a>
                        <a href="#" class="dropdown-item">Another action</a>
                        <a href="#" class="dropdown-item"
                          >Something else here</a
                        >
                        <a class="dropdown-divider"></a>
                        <a href="#" class="dropdown-item">Separated link</a>
                      </div>
                    </div>
                    <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="remove"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <!-- Sales Chart Canvas -->
                      <category-subCategory></category-subCategory>


                      <!-- /.chart-responsive -->
                    </div>
                  </div>
                  <!-- /.row -->
                </div>
                <!-- ./card-body -->

                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Category wise SubCategory</h5>

                  <div class="card-tools">
                    <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="collapse"
                    >
                      <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">
                      <button
                        type="button"
                        class="btn btn-tool dropdown-toggle"
                        data-toggle="dropdown"
                      >
                        <i class="fas fa-wrench"></i>
                      </button>
                      <div
                        class="dropdown-menu dropdown-menu-right"
                        role="menu"
                      >
                        <a href="#" class="dropdown-item">Action</a>
                        <a href="#" class="dropdown-item">Another action</a>
                        <a href="#" class="dropdown-item"
                          >Something else here</a
                        >
                        <a class="dropdown-divider"></a>
                        <a href="#" class="dropdown-item">Separated link</a>
                      </div>
                    </div>
                    <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="remove"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <!-- Sales Chart Canvas -->
                      <subcategory-product></subcategory-product>

                      <!-- /.chart-responsive -->
                    </div>
                  </div>
                  <!-- /.row -->
                </div>
                <!-- ./card-body -->

                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->

          <!-- Main row -->

          <!-- /.row -->
        </div>
        <!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>

<script>
export default {

  created() {
    axios.get("/categoryCount")
      .then((response) => {
        this.categoryCount = response.data.categoryCount;
     
      });
    axios.get("/subCategoryCount")
      .then((response) => {
        this.subCategoryCount = response.data.subCategoryCount;
      });
    
    axios.get("/productCount")
      .then((response) => {
        this.productCount = response.data.productCount;
      });

    axios.get("/employeeCount")
      .then((response) => {
        this.employeeCount = response.data.employeeCount;
      });
    axios.get("/todayCash")
      .then((response) => {
        this.todayCash = response.data.todayCash;
      });
     axios.get("/todayExpense")
      .then((response) => {
        this.todayExpense = response.data.todayExpense;
      });

    axios.get("/orderStatus")
      .then((response) => {
        this.orderStatus = response.data.orderStatus;
      });
    axios.get("/customerCount")
      .then((response) => {
        this.customerCount = response.data.customerCount;
      });
  },

  data() {
    return {
      categoryCount: "",
      subCategoryCount: "",
      productCount: "",
      employeeCount: "",
      todayExpense: "",
      todayCash: "",
      orderStatus: "",
      customerCount: "",

      errors: {},
    };
  },

  methods: {
   
  },
};
</script>


<style>
</style>