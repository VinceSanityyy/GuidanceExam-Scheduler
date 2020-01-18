<template>
   <div class="row">
      <div class="col-md-3">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">Add Event</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
               </div>
            </div>
            <div class="box-body">
               <div class="form-group">
                  <label>Type</label>
                  <select class="form-control">
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
                     <input type="date" class="form-control pull-right">
                  </div>
               </div>
                <button type="button" class="btn btn-block btn-success">Request Schedule</button>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   export default {
       mounted() {
           console.log('Component mounted.')
       }
   }
</script>