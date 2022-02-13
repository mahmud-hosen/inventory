<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <!--/. container-fluid -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-9 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Product List</h3>
                  <div class="text-right">
                    <router-link to="/productAdd" class="btn btn-primary btn-sm"
                      >Add
                    </router-link>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(productList, x) in getProductListFromStore" :key="productList.id">
                        <td>{{ x + 1 }}</td>
                        <td>{{ productList.product_name }}</td>
                        <td>{{ productList.cat_name }}</td>
                        <td>{{ productList.sub_cat_name }}</td>
                        <td>{{ productList.sub_cat_description }}</td>
                        <td>
                          <img
                            v-bind:src="`/images/product/${productList.product_img}`"
                            class="image"
                          />
                        </td>
                        <td>
                          <span v-if="productList.status == 1" class="badge badge-info right">Published</span>
                          <span v-if="productList.status == 0" class="badge badge-danger right">Unpublished</span>
                        </td>

                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <router-link :to="`/productEdit/${productList.id}`" class="btn btn-info "><i class="fas fa-edit"></i></router-link>
                            <a @click.prevent="productDelete(productList.id)" class="btn btn-danger "><i class="fas fa-trash"></i></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/. container-fluid -->
      </section>
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>

<script>
export default {
  name: "List",

  //  Step: 4
  mounted() {
    this.$store.dispatch("productListSaveInStore");
  },

  //  Step: 10
  computed: {
    getProductListFromStore() {
      return this.$store.getters.productListFromStore;
    },
  },

  methods: {
    productDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this product!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get("/productDelete/" + id).then((response) => {
            this.$store.dispatch("productListSaveInStore");
            Swal.fire(
              "Deleted!",
              "Product deleted successfully",
              "success"
            );
          });
        }
      });
    },
  },
};
</script>

<style>
.image {
  height: 70px;
  width: 100px;
}

</style>