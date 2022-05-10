<template>
  <div class="chart">
    <GChart type="ColumnChart" :data="chartData" :options="chartOptions" />
  </div>
</template>

<script>
import { GChart } from "vue-google-charts";
export default {
  data() {
    return {
      result: [],

      chartData: [["Category","SubCategory"]],

      chartOptions: {
        chart: {
          title: "Company Performance",
          subtitle: "Sales, Expenses, and Profit: 2014-2017",
        },
      },
    };
  },

  mounted() {
    axios.get('/categoryWiseSubcategory').then((response)=>{
      for(let i=0; i<response.data.categoryWiseSubcategory.length; i++)
      {
        this.result[0] = response.data.categoryWiseSubcategory[i].category_name;
        this.result[1] = response.data.categoryWiseSubcategory[i].total;
        this.chartData.push(this.result);
        this.result = [];
      }
    })
  },
};
</script>

<style>
</style>