<template>
   <div class="row">
      <div class="col-md-12">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">List of Students</h3>
               <div class="box-tools">
                  <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">Add new<i class="fa fa-plus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <table id="myTable" class="table table-hover no-padding">
                     <thead>
                     <tr>
                        <th>Id Number</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Current Status</th>
                        <th>Actions</th>
                     </tr>
                     </thead>
                      <tbody>
                     <tr v-for="user in users" :key="user.id">
                        <td>{{user.id_number}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.sex}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.course}}</td>
                        <td v-if="user.isConfirmed == 1"><span class="label label-success">Approved</span></td>
                        <td v-else><span class="label label-danger">Pending</span></td>
                        <td>
                           <a href="#"  data-toggle="modal" data-target="#exampleModal" @click="editModal(user)">
                           <i class="fa fa-edit"></i>
                           </a>
                           <a href="#" @click="deleteUser(user.id)">
                           <i class="fa fa-trash text-red"></i>
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
                  <h4 class="modal-title" id="exampleModalLabel">Add Student</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form @submit.prevent="editmode ? updateUser() : createUser()">
                  <div class="modal-body">
                     <div class="form-group">
                        <label>Name</label>
                        <input
                           v-model="form.name"
                           type="text"
                           name="name"
                           placeholder="Name"
                           class="form-control"
                           :class="{ 'is-invalid': form.errors.has('name') }"
                           />
                        <has-error :form="form" field="name"></has-error>
                     </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input
                           v-model="form.email"
                           type="text"
                           name="email"
                           placeholder="Email"
                           class="form-control"
                           :class="{ 'is-invalid': form.errors.has('email') }"
                           />
                        <has-error :form="form" field="email"></has-error>
                     </div>
                       <div class="col-md-6 form-group">
                        <label>ID Number</label>
                        <input
                           v-model="form.id_number"
                           type="text"
                           
                           name="id_number"
                           placeholder="Id Number"
                           class="form-control"
                           :class="{ 'is-invalid': form.errors.has('id_number') }"
                           />
                        <has-error :form="form" field="id_number"></has-error>
                     </div>
                  
                        <div class="col-md-6 form-group">
                        <label>Age</label>
                        <input
                           v-model="form.age"
                           type="number"
                           name="age"
                           min="0"
                           placeholder="Age"
                           class="form-control"
                           :class="{ 'is-invalid': form.errors.has('age') }"
                           />
                        <has-error :form="form" field="age"></has-error>
                     </div>
                        <div class="col-md-6 form-group">
                        <label>Mobile Number</label>
                        <input
                           v-model="form.mobile"
                           type="text"
                           name="mobile"
                           placeholder="Mobile Number"
                           class="form-control"
                           :class="{ 'is-invalid': form.errors.has('mobile') }"
                           />
                        <has-error :form="form" field="mobile"></has-error>
                     </div>
                        <div class="col-md-6 form-group">
                        <label>Course</label>
                           <select  v-model="form.course"  id="course" class="form-control" name="course" >
                                    <option value = "BSIT/CS">BSIT/CS</option>
                                    <option value = "BSED/BEED">BSED/BEED</option>
                                    <option value = "BSBA">BSBA</option>
                                    <option value = "BSAT/BSA">BSAT/BSA</option>
                                    <option value = "BSHRM/TM">BSHRM/TM</option>
                                    <option value = "BSCJ">BSCJ</option>
                                    <option value = "ENG'G">ENG'G</option>
                                    <option value = "DASE">DASE</option>
                                </select>
                     </div>
                        <div class="col-md-6 form-group">
                        <label>Year Level</label>
                          <select  v-model="form.yearlevel"  id="yearlevel" class="form-control " name="yearlevel" >
                                    <option value = "1st">First Year</option>
                                    <option value = "2nd">Second Year</option>
                                    <option value = "3rd">Third Year</option>
                                    <option value = "4th">Fourth Year</option>
                                    <option value = "5th">Fifth Year</option>
                                  </select>
                     </div>
                        <div class="col-md-6 form-group">
                        <label>Gender</label>
                         <select id="sex"  v-model="form.sex"  class="form-control" name="sex">
                                    <option value = "Male">Male</option>
                                    <option value = "Female">Female</option>
                                  </select>
                     </div>
                     <div class="form-group">
                        <label>Status</label>
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
               users: [],
               form: new Form({
                   id:'',
                   name:'',
                   id_number:'',
                   isConfirmed:'',
                   email:'',
                   mobile:'',
                   age:'',
                   course:'',
                   sex:'',
                   yearlevel:''

               })
           }
       },
       methods:{
           getUsers(){
                axios.get('/getUsers')
                 .then((res)=>{
                   this.users = res.data
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
             newModal(){
            this.editmode = false
            this.form.clear()
            this.form.reset()
            $('#exampleModal').modal('show')
          },
        createUser(){
            this.form.post('/addUser')
              .then(({data})=>{
                swal.fire("Record Created!", "", "success");
                $('#exampleModal').modal('hide');
                $(".modal-backdrop").remove();
                this.getUsers()
               
                console.log(data)
              })
          },
         editModal(user){
            this.editmode = true
            this.form.reset()
            $('#exampleModal').modal('show')
            this.form.fill(user)
          },
         updateUser(){
            this.form.put('/updateUser/' + this.form.id)
              .then(()=>{
                  swal.fire("Record Updated!", "", "success");
                $('#exampleModal').modal('hide');
                $(".modal-backdrop").remove();
             this.getUsers()
              })
              .catch((e)=>{
                console.log(e)
              })
          },
        deleteUser(id){
             swal.fire({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
             }).then(result => {
              //send delete request
              if (result.value) {
              this.form.delete('/deleteUser/' +id)
                .then(()=>{
                    swal.fire("Deleted!", "", "success");
                    this.getUsers()
                })
                .catch(()=>{
                    swal.fire("Deleted!", "", "success");
                    this.getUsers()
                });
              }
          });
          }
       },
       created() {
           this.getUsers()
           console.log('Component mounted.')
       }
   }
</script>