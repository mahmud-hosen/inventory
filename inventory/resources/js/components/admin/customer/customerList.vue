<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <!--/. container-fluid -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Customer List</h3>
                  <div class="text-right">
                    <router-link
                      to="/customerAdd"
                      class="btn btn-primary btn-sm"
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
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Shop Name</th>
                        <th>Address</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(customer, x) in getCustomerListFromStore"
                        :key="customer.id"
                      >
                        <td>{{ x + 1 }}</td>
                        <td>{{ customer.customer_name }}</td>
                        <td>{{ customer.customer_phone }}</td>
                        <td>{{ customer.customer_shop_name }}</td>
                        <td>{{ customer.customer_address }}</td>
                        <td>{{ customer.customer_bank_name }}</td>
                        <td>{{ customer.customer_account_number }}</td>

                        <td v-if="customer.customer_image != null">
                          <img
                            v-bind:src="`/images/customer/${customer.customer_image}`"
                            class="image"
                          />
                        </td>
                        <td v-if="customer.customer_image == null">
                          <img
                            v-bind:src="`/images/user/user.png`"
                            class="image"
                          />
                        </td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <router-link
                              :to="`/customerEdit/${customer.id}`"
                              class="btn btn-info"
                              ><i class="fas fa-edit"></i
                            ></router-link>
                            <a
                              @click.prevent="customerDelete(customer.id)"
                              class="btn btn-danger"
                              ><i class="fas fa-trash"></i
                            ></a>
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
    this.$store.dispatch("customerListSaveInStore");
  },

  computed: {
    getCustomerListFromStore() {
      return this.$store.getters.customerListFromStore;
    },
  },

  methods: {
    customerDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this customer!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get("/customerDelete/" + id).then((response) => {
            this.$store.dispatch("customerListSaveInStore");
            Swal.fire("Deleted!", "Customer deleted successfully", "success");
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