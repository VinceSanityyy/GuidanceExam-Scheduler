<template>
   <div class="row">
      <div class="col-md-12">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title" style="text-align:center">
                  Reports
               </h3>
               <div class="box-body">
                    <div class="col-md-12">
                        <div class="col-md-4 form-group">
                        <label>From</label>
                          <date-picker 
                          name="date" id="date" v-model="date_from" 
                          :config="opt" ></date-picker>
                          </div>
                            <div class="col-md-4 form-group">
                            <label>To</label>
                          <date-picker
                          name="date" id="date" v-model="date_to" 
                          :config="opt" ></date-picker>
                          </div>
                          <div class="col-md-4">
                              <br>
                                <button @click="
                                getSchedulesYear(),
                                getSchedulesGender(),
                                getSchedulesType(),
                                getSchedulesCourse()"  class="btn btn-primary btn-block">Apply Filter</button>
                          </div>
                          <!-- <div class="col-md-2">
                                <button  class="btn btn-primary btn-block">Clear Filter</button>
                          </div> -->
                    </div>
                  <div class="col-md-6">
                     <div class="box box-success">
                        <div class="box-header with-border">
                           <h3 style="text-align:center" class="box-title">Year Level</h3>
                        </div>
                        <div  align="left" id="chartYearLevel">
                           <fusioncharts :type="chartYearLevel.type" :width="chartYearLevel.width" 
                              :height="chartYearLevel.height" 
                              :dataFormat="chartYearLevel.dataFormat" 
                              :dataSource="chartYearLevel.dataSource ">
                           </fusioncharts>
                        </div>
                     </div>
                  </div>
                    <div class="col-md-6">
                     <div class="box box-success">
                        <div class="box-header with-border">
                           <h3 style="text-align:center" class="box-title">Courses</h3>
                        </div>
                        <div  align="left" id="chartCourse">
                           <fusioncharts :type="chartCourse.type" :width="chartCourse.width" 
                              :height="chartCourse.height" 
                              :dataFormat="chartCourse.dataFormat" 
                              :dataSource="chartCourse.dataSource ">
                           </fusioncharts>
                        </div>
                     </div>
                  </div>
                    <div class="col-md-6">
                     <div class="box box-success">
                        <div class="box-header with-border">
                           <h3 style="text-align:center" class="box-title">Type</h3>
                        </div>
                        <div  align="left" id="chartSchedType">
                           <fusioncharts :type="chartSchedType.type" :width="chartSchedType.width" 
                              :height="chartSchedType.height" 
                              :dataFormat="chartSchedType.dataFormat" 
                              :dataSource="chartSchedType.dataSource ">
                           </fusioncharts>
                        </div>
                     </div>
                  </div>
                    <div class="col-md-6">
                     <div class="box box-success">
                        <div class="box-header with-border">
                           <h3 style="text-align:center" class="box-title">Gender</h3>
                        </div>
                        <div  align="left" id="chartSchedGender">
                           <fusioncharts :type="chartSchedGender.type" :width="chartSchedGender.width" 
                              :height="chartSchedGender.height" 
                              :dataFormat="chartSchedGender.dataFormat" 
                              :dataSource="chartSchedGender.dataSource ">
                           </fusioncharts>
                        </div>
                     </div>
                  </div>
                 
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
    import Vue from 'vue';
    import VueFusionCharts from 'vue-fusioncharts';
    import FusionCharts from 'fusioncharts';
    import Column2D from 'fusioncharts/fusioncharts.charts';
    import Charts from 'fusioncharts/fusioncharts.charts';
    import excelexport from 'fusioncharts/fusioncharts.excelexport';
    import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion';
  
    Vue.use(VueFusionCharts, FusionCharts, Column2D, FusionTheme, Charts, excelexport);
   

    export default {
        data(){
            return{
                date_from: new Date(),
                opt:{
                    showClear: true,
                    useCurrent: false,
                    format: 'YYYY-MM'
                },
                date_to: new Date(),
                opt:{
                    showClear: true,
                    useCurrent: false,
                    format: 'YYYY-MM'
                },
                chartYearLevel:{
                    type: 'column2d',
                    width: '500',
                    height: '320',
                    dataFormat: 'json',
                    renderAt:'chartYearLevel',
                    dataSource:{
                        chart:{
                            exportenabled: "1",
                            exportfilename: "Schedules by Year Level",
                            theme: 'fusion',
                            decimals: 1,
                            showpercentagevalues:1,
                            palettecolors: "#1aa308,#ede909,#cc210e,#2e25db,#000000"
                        },
                        data:[]
                    }
                },
                chartCourse:{
                        type: 'column2d',
                        width: '500',
                        height: '320',
                        dataFormat: 'json',
                        renderAt:'chartCourse',
                        dataSource:{
                            chart:{
                                exportenabled: "1",
                                exportfilename: "Schedules by Course",
                                theme: 'fusion',
                                decimals: 1,
                                showpercentagevalues:1,
                                palettecolors: "#1bc41e,#deeb31,#eb3a31,#3197eb,#a731eb,#565159,#000000,#f09a1a"
                            },
                            data:[]
                        }
                    },
                    chartSchedType:{
                        type: 'column2d',
                        width: '500',
                        height: '320',
                        dataFormat: 'json',
                        renderAt:'chartSchedType',
                        dataSource:{
                            chart:{
                                exportenabled: "1",
                                exportfilename: "Schedules by Type",
                                theme: 'fusion',
                                decimals: 1,
                                showpercentagevalues:1,
                                palettecolors: "#cc210e,#2e25db,#ede909"
                            },
                            data:[]
                        }
                    },
                    chartSchedGender:{
                        type: 'column2d',
                        width: '500',
                        height: '320',
                        dataFormat: 'json',
                        renderAt:'chartSchedGender',
                        dataSource:{
                            chart:{
                                exportenabled: "1",
                                exportfilename: "Schedules by Gender",
                                theme: 'fusion',
                                decimals: 1,
                                showpercentagevalues:1,
                                palettecolors: "#e81a5b,#2e25db"
                            },
                            data:[]
                        }
                    },
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            // this.getSchedulesYear()
        },
        methods:{
            getSchedulesYear(){
                let params = { date_from: this.date_from, date_to: this.date_to };
                let paramString = new URLSearchParams(params);
                axios.get(`/getSchedulesYear?${paramString.toString()}`)
                    .then((res)=>{
                        this.chartYearLevel.dataSource.data = []
                        res.data.forEach(val=>{
                            this.chartYearLevel.dataSource.data.push(val)
                        })
                    })
            },
            getSchedulesCourse(){
                let params = { date_from: this.date_from, date_to: this.date_to };
                let paramString = new URLSearchParams(params);
                  axios.get(`/getSchedulesCourse?${paramString.toString()}`)
                    .then((res)=>{
                        this.chartCourse.dataSource.data = []
                        res.data.forEach(val=>{
                            this.chartCourse.dataSource.data.push(val)
                        })
                    })
            },
            getSchedulesType(){
                let params = { date_from: this.date_from, date_to: this.date_to };
                let paramString = new URLSearchParams(params);
                  axios.get(`/getSchedulesType?${paramString.toString()}`)
                    .then((res)=>{
                        this.chartSchedType.dataSource.data = []
                        res.data.forEach(val=>{
                            this.chartSchedType.dataSource.data.push(val)
                        })
                    })
            },
            getSchedulesGender(){
                let params = { date_from: this.date_from, date_to: this.date_to };
                let paramString = new URLSearchParams(params);
                  axios.get(`/getSchedulesGender?${paramString.toString()}`)
                    .then((res)=>{
                        this.chartSchedGender.dataSource.data = []
                        res.data.forEach(val=>{
                            this.chartSchedGender.dataSource.data.push(val)
                        })
                    })
            },
        }
    }
</script>
