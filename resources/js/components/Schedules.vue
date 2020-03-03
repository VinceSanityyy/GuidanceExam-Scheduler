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
                        <th>Schedule Type</th>
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
                        <td>{{schedule.start_time}} - {{schedule.end_time}}</td>
                        <td>{{schedule.type}}</td>
                        <td v-if="schedule.isConfirmed == 1"><span class="label label-success">Approved</span></td>
                        <td v-else-if="schedule.isConfirmed == 2"><span class="label label-info">Finished Exam in Mobile</span></td>
                        <td v-else><span class="label label-danger">Pending</span></td>
                        <td>
                           <a href="#" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#exampleModal" @click="editModal(schedule)">
                          Set status
                           </a>

                            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal1" @click="editModal(schedule)">
                           Re-schedule
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
                  <span><i data-dismiss="modal" aria-label="Close" class="fa fa-close close"></i></span>
                  <h4 class="modal-title" id="exampleModalLabel">Update</h4>
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
                    
                     <button type="submit" class="btn btn-primary">Save changes</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                 
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Modal -->

      <!-- Modal Resched -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <span><i data-dismiss="modal" aria-label="Close" class="fa fa-close close"></i></span>
                  <h4 class="modal-title" id="exampleModalLabel">Re Schedule</h4>
               </div>
               <form @submit.prevent=" reSched()">
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
                                    <label>Date:</label>
                                    <div class="input-group date">
                                       <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                       </div>
                                    <date-picker required name="date" id="date" v-model="form.date" :config="opt" ></date-picker>
                                    <has-error :form="form" field="date"></has-error>
                                    </div>
                        </div>
                          <div class="form-group">
                                <label>From:</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <date-picker name="from" id="from" v-model="form.from" :config="options"></date-picker>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>To:</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <date-picker name="to" id="to" v-model="form.to" :config="options"></date-picker>
                                </div>
                            </div>
                  </div>
                  <div class="modal-footer">
                    
                     <button type="submit" class="btn btn-primary">Save changes</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                 
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Modal Resched -->
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
                   date:'',
                   from:'',
                   to:''
               }),
                   date: new Date(),
                    opt: {
                    format: 'YYYY-MM-DD',
                    showClear: true,
                    showClose: true,
                  },

                  from: new Date(),
                        options: {
                        format: 'HH:mm',
                        showClear: true,
                        showClose: true,
                        },
                  to: new Date(),
                        options: {
                        format: 'HH:mm',
                        showClear: true,
                        showClose: true,
                        },
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

          reSched(){
             $('#exampleModal1').modal('hide');
             $(".modal-backdrop").remove();
               let loader = this.$loading.show({
                            container: this.fullPage ? null : this.$refs.formContainer,
                            onCancel: this.onCancel,
                            color: '#c91010',
                            loader: 'bars',
                            width: 80,
                            height: 100,
                            })
            this.form.put('/reSched/' + this.form.scid)
              .then(()=>{
                  swal.fire("Request Re-scheduled!", "", "success");
                  loader.hide()  
               
             this.getSchedules()
              })
              .catch((e)=>{
                console.log(e)
              })
          }
       },
       created() {
           this.getSchedules()
           console.log('Component mounted.')
       }
   }
</script>
