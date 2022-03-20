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

      // Array will be automatically processed with visualization.arrayToDataTable function

      // chartData: [
      //   ['Category', 'Content'],

      // ],
      chartData: [
        ["Year", "Sales", "Expenses", "Profit"],
        ["2014", 1000, 400, 200],
        ["2015", 1170, 460, 250],
        ["2016", 660, 1120, 300],
        ["2017", 1030, 540, 350],
      ],

      chartOptions: {
        chart: {
          title: "Company Performance",
          subtitle: "Sales, Expenses, and Profit: 2014-2017",
        },
      },
    };
  },

  mounted() {
    // axios.get('/categoryWiseContent').then((response)=>{
    //   for(let i=0; i<response.data.categoryWiseContent.length; i++)
    //   {
    //     this.result[0] = response.data.categoryWiseContent[i].cat_name;
    //     this.result[1] = response.data.categoryWiseContent[i].total;
    //     this.chartData.push(this.result);
    //     this.result = [];
    //   }
    // })
  },
};
</script>

<style>
</style>