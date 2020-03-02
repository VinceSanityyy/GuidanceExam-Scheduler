<template>
  <div class="row">
      <div class="col-md-12">
          <div class="box box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">
                      Examination Results
                  </h3>
              </div>
              <div class="box-body">
                <table id="myTable" class="table table-hover no-padding">
                  <thead>
                      <tr>
                          <th>Student Name</th>
                          <th>Type of Exam</th>
                          <th>Course</th>
                          <th>Status</th>
                          <th>Exam taken</th>
                          <th>Result</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="result in results" :key="result.id">
                          <td>{{result.name}}</td>
                          <td>{{result.schedule_type}}</td>
                          <td>{{result.course}}</td>
                          <!-- <div v-if="1 == 2 || (1 + 2 == 3 && 4 == 4)">I am visible!</div> -->
                          <td><span class="label label-info">Finished Exam in Mobile</span></td>
                          <td>{{result.start_date | moment("dddd, MMMM D, YYYY")}}</td>
                          <td v-if="result.score >= 0 && result.score <=13"><span  class="label label-success">Mild</span></td>
                          <td v-else-if="result.score >= 14 && result.score <=19"><span  class="label label-info">Minimal</span></td>
                          <td v-else-if="result.score >= 20 && result.score <=28"><span  class="label label-warning">Moderate</span></td>
                          <td v-else><span  class="label label-danger">Severe</span></td>
                      </tr>
                  </tbody>
              </table>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import datatables from 'datatables'
    export default {
        data(){
            return{
                results:[]
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            getResults(){
                axios.get('/getAllScore')
                    .then((res)=>{
                        this.results = res.data
                        this.myTable()
                    })
            },
             myTable(){
               $(document).ready( function () {
                     $('#myTable').DataTable();
                  });
            },
        },
        created(){
            this.getResults()
        }
    }
</script>
