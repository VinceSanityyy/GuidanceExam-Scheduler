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
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="result in results" :key="result.id">
                          <td>{{result.name}}</td>
                          <td>{{result.schedule_type}}</td>
                          <td>{{result.course}}</td>
                          <!-- <div v-if="1 == 2 || (1 + 2 == 3 && 4 == 4)">I am visible!</div> -->
                          <td v-if="result.isConfirmed == 4"><span class="label label-primary">Finished</span></td>
                          <td v-else-if="result.isConfirmed == 2"><span class="label label-info">Finished Exam in Mobile</span></td>
                          <td v-else><span class="label label-warning">Waiting</span></td>

                          <td>{{result.start_date | moment("dddd, MMMM D, YYYY")}}</td>
                         
                          <td v-if="result.score >= 1 && result.score <=13"><span  class="label label-success">Mild</span></td>
                          <td v-else-if="result.score == 0 "><span  class="label label-success">Waiting for result</span></td>
                          <td v-else-if="result.score >= 14 && result.score <=19"><span  class="label label-info">Minimal</span></td>
                          <td v-else-if="result.score >= 20 && result.score <=28"><span  class="label label-warning">Moderate</span></td>
                          <td v-else><span  class="label label-danger">Severe</span></td>
                          <td> <a href="#" class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#exampleModal" @click="editModal(result)">
                          Edit
                           </a></td>
                      </tr>
                  </tbody>
              </table>
              </div>
          </div>
      </div>
      <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                  <span><i data-dismiss="modal" aria-label="Close" class="fa fa-close close"></i></span>
                <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
            </div>
            <div class="modal-body">
               <form @submit.prevent="updateResult()">
                    <div class="form-group">
                        <label>Set Status</label>
                        <select class="form-control" name="status" 
                           v-model="form.status" 
                           :class="{ 'is-invalid': form.errors.has('status') }">
                           <option value="4">Finished Examination</option>
                           <option value="0">Pending</option>
                        </select>
                     </div>
                      <div class="form-group">
                        <label>Set Result</label>
                        <select class="form-control" name="result" 
                           v-model="form.result" 
                           :class="{ 'is-invalid': form.errors.has('result') }">
                           <option value="Mild">Mild</option>
                           <option value="Minimal">Minimal</option>
                           <option value="Moderate">Moderate</option>
                           <option value="Severe">Severe</option>
                        </select>
                     </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
               </form>
            </div>
           
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
                results:[],
                editmode: false,
                form: new Form({
                     resId:'',
                     result:'',
                     status:''
                })
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
            editModal(result){
                this.editmode = true
                this.form.reset()
                $('#exampleModal').modal('show')
                this.form.fill(result)
            },
            updateResult(){
             $('#exampleModal').modal('hide');
             $(".modal-backdrop").remove();
             this.form.put('/setScheduleResults/'+this.form.resId)
                .then(()=>{
                   swal.fire("Record Updated!", "", "success");
                   this.getResults()
                })
            }
        },
        created(){
            this.getResults()
        }
    }
</script>
