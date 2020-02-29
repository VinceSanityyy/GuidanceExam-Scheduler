<template>
   <div class="row">
      <div class="col-md-12">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">Schedules</h3>
            </div>
            <div class="box-body">
               <table id="myTable" class="table table-hover no-padding">
                  <thead>
                     <tr>
                        <th>Id Number</th>
                        <th>Name</th>
                        <th>Type of Appointment</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Current Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr v-for="schedule in schedules" :key="schedule.scid">
                        <td>{{schedule.id_number}}</td>
                        <td>{{schedule.name}}</td>
                        <td>{{schedule.schedule_type}}</td>
                        <td>{{schedule.date.trim() | moment("dddd, MMMM D, YYYY")}}</td>
                        <td>{{schedule.start_time.trim() | moment(" hh:mm a")}} - {{schedule.end_time | moment(" hh:mm a")}}</td>
                        <td v-if="schedule.isConfirmed == 1"><span class="label label-success">Approved</span></td>
                        <td v-else-if="schedule.isConfirmed == 2"><span class="label label-info">Finished Exam in Mobile</span></td>
                        <td v-else><span class="label label-danger">Pending</span></td>
                        <td>
                           <a href="#"  data-toggle="modal" data-target="#exampleModal" @click="editModal(schedule)">
                           <i class="fa fa-edit"></i>
                           </a>
                        </td>
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
                  <h4 class="modal-title" id="exampleModalLabel">Update</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form @submit.prevent=" updateSchedule()">
                  <div class="modal-body">
                  
                        <input
                           v-model="form.email"
                           type="hidden"
                           name="email"
                           placeholder="Email"
                           class="form-control"
                           :class="{ 'is-invalid': form.errors.has('email') }"
                           />
                        <has-error :form="form" field="email"></has-error>

                           <input
                           v-model="form.mobile"
                           type="hidden"
                           name="mobile"
                           placeholder="Mobile"
                           class="form-control"
                           :class="{ 'is-invalid': form.errors.has('mobile') }"
                           />
                        <has-error :form="form" field="mobile"></has-error>
                    
                     <div class="form-group">
                        <label>Change Status</label>
                        <select class="form-control" name="isConfirmed" 
                           v-model="form.isConfirmed" 
                           :class="{ 'is-invalid': form.errors.has('isConfirmed') }">
                           <option value="1">Confirm</option>
                           <option value="0">Pending</option>
                        </select>
                     </div>
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
</template>
<script>
import datatables from 'datatables'
   export default {
       data(){
           return{
               editmode: false,
               schedules: [],
               form: new Form({
                   scid:'',
                   isConfirmed:'',
                   email:'',
                   mobile:'',
               })
           }
       },
       methods:{
           getSchedules(){
                axios.get('/getAllSchedule')
                 .then((res)=>{
                   this.schedules = res.data
                   this.myTable()
                 })
                 .catch((e)=>{
                   console.log(e)
                 })
           },
             myTable(){
               $(document).ready( function () {
                     $('#myTable').DataTable();
                  });
               },
         editModal(schedule){
            this.editmode = true
            this.form.reset()
            $('#exampleModal').modal('show')
            this.form.fill(schedule)
          },
         updateSchedule(){
             $('#exampleModal').modal('hide');
             $(".modal-backdrop").remove();
               let loader = this.$loading.show({
                            container: this.fullPage ? null : this.$refs.formContainer,
                            onCancel: this.onCancel,
                            color: '#c91010',
                            loader: 'bars',
                            width: 80,
                            height: 100,
                            })
            this.form.put('/updateSchedule/' + this.form.scid)
              .then(()=>{
                  swal.fire("Status Updated!", "", "success");
                  loader.hide()  
               
             this.getSchedules()
              })
              .catch((e)=>{
                console.log(e)
              })
          },
       },
       created() {
           this.getSchedules()
           console.log('Component mounted.')
       }
   }
</script>
