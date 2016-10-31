<template>
    <div>
    <div class="full-width">
        <div class="header">
            <div class="container">
                <h1 style="text-align:center; color:#fff;">MY TODO APP</h1>
            </div>
        </div>
    </div>
    <div class="full-width">
        <div class="container">
            <h4 style="text-align:center;">Todo List Items:-</h4>
                <span @click="addtask" class="btn btn-default">
                    <i class="glyphicon glyphicon-plus"></i>Add Task
                </span>
            <ul class="list-group mt-10">
                <li class="list-group-item" v-for="task in list">
                    <span @click="completeTask(task)">{{ task.list_item }}</span>
                    <span class="pull-right" style="margin-top:-3px;">
                    <a href="#"><span class="glyphicon glyphicon-pencil pad-10" @click="editTask(task)"></span></a>
                    <a href="#"><span class="glyphicon glyphicon-trash pad-10" @click="deleteTask(task)"></span></a>
                    </span>
                </li>
            </ul>
            <div>
            <div class="col-lg-12 col-md-12 col-sm-12" v-if="complete.length">
              <div class="row">
                <button class="btn btn-primary" @click="showComplete">Show Completed Task</button>
                <div class="mt-10" id="show-complete" style="display:none;">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="task in complete">
                            <span class="complete" @click="uncompleteTask(task)">{{ task.list_item }}</span>
                            <span class="pull-right" style="margin-top:-3px;">
                                <span class="glyphicon glyphicon-trash pad-10" @click="deleteTask(task)"></span>
                            </span> 
                        </li>
                    </ul>
                <button @click="clearCompleted" class="btn btn-danger">clear completed</button>
                </div>
                </div>
              </div>


                <!-- Add Task Modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="add-task">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Todo Task</h4>
                      </div>

                      <form>
                      <div class="modal-body">
                          <div class="col-md-12" style="margin-bottom:10px;">
                              <label>Task Name:-</label>
                              <input type="text" class="form-control" v-model="createForm.item">
                          </div>
                      </div>
                      </form>

                      <div class="modal-footer" style="margin-top:10px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveTask">Save</button>
                      </div>
                      
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- Edit Task Modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="edit-task">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Todo Task</h4>
                      </div>
                      <form>
                      <div class="modal-body">
                          <div class="col-md-12" style="margin-bottom:10px;">
                              <label>Task Name:-</label>
                              <input type="text" class="form-control" v-model="editForm.item">
                          </div>
                      </div>
                      </form>
                      <div class="modal-footer" style="margin-top:10px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="updateItem">Update</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
    </div>
    </div>
</template>

<script>
	export default {
		data(){
			return{
				list:[],
        complete:[],
				createForm: {
                    item: '',
                    errors: []
                },

                editForm:{
                	item: ''
                }
			};
		},

		created(){

        this.getlist();

		},

		methods:{

            addtask() {
            	$('#add-task').modal('show');
            },


            editTask(task) {
            	this.editForm.id 	=	task.id;
            	this.editForm.item 	=	task.list_item;

            	$('#edit-task').modal('show');
            },

            showComplete(){
                $('#show-complete').toggle();
            },

            getlist(){
                this.$http.get('/api/task')
                          .then(response => {
                            this.list = response.data['list'];
                            this.complete = response.data['complete'];

                          });
            },

            saveTask(){
              this.persists('post','/api/addtask',
                            this.createForm,'#add-task'
              );
            },

            updateItem(){
              this.persists('put','/api/updatetask/'+this.editForm.id,
                            this.editForm,'#edit-task'
              );
            },

            deleteTask(task){
                if(confirm("Are you sure..! You want to delete this task")){
                      this.$http.delete('/api/delete-task/'+task.id)
                        .then(response =>{
                            this.getlist();
                        });
                }
            },

            completeTask(task){
                this.$http.get('/api/complete-task/'+ task.id)
                  .then(response =>{
                      this.getlist();
                  });
            },

            uncompleteTask(task){
                this.$http.put('api/uncomplete/'+ task.id)
                  .then(response => {
                      this.getlist();
                  });
            },

            persists(method,uri,form,popup){
            
              this.$http[method](uri,form)
                .then(response =>{
                      form.item   = '';
                      form.errors = [];
                      $(popup).modal('hide');
                      this.getlist();
                })
                .catch(response =>{
                    if(typeof response.data === 'object'){
                        form.errors   = _.flatten(_.toArray(response.data));
                    }else{
                        form.errors    = ['Something went worng. Please try again'];
                    }
                });
            
            },

            clearCompleted(){
                this.$http.get('api/clearcompleted')
                .then(response => {
                    this.getlist();
                });
            }
		}
	}
</script>