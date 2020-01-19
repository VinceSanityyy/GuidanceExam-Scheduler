<template>
   <div class="row">
      <div class="col-md-3">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">Add Event</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="remove"></button>
               </div>
            </div>
            <form @click ="createSchedule()">
            <div class="box-body">
               <div class="form-group">
                  <label>Type</label>
                  <select  v-model="form.type" class="form-control">
                     <option>Consultation</option>
                     <option>Examination</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Date:</label>
                  <div class="input-group date">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                     <input  v-model="form.date" type="date" class="form-control pull-right">
                  </div>
               </div>
                <button type="button" class="btn btn-block btn-success">Request Schedule</button>
            </div>
            </form>
         </div>
      </div>
      <div class="col-md-9">
         <div class="box box-success">
            <div class="box-header with-border">
            <h3 class="box-title">Calendar Goes Here</h3>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   export default {
      data(){
         return{
            form: new Form({
               date:'',
               type:''
            })
         }
      },
      methods:{
          createSchedule(){
            this.form.post('/addSchedule')
              .then(({data})=>{
                swal.fire("Schedule Created!", "", "success");
                console.log(data)
              })
          },
          getSchedules(){
             console.log('Schedules must be set to 1 to display')
          }
      },
       mounted() {
          this.getSchedules()
           console.log('Component mounted.')
       }
   }
</script>