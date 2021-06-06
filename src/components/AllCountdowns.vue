<template>
    <div class="fizzy_content_wrap">
        <div class="fizzy_all_countdowns" v-loading="loading">
            <el-row>
                <el-col>
                    <predefined-countdowns v-model:visibility="showAddFormModal"></predefined-countdowns>
                    <welcome v-if="!allCountdowns.length" v-model="showAddFormModal"></welcome>
                    <div v-else>
                        <div class="ninja_countdown_table">
                            <div class="fizzy_table_actions">
                                <div class="nina_search_action">
                                    <el-input type="text" size="medium" v-model="search_string"  @keyup.enter="getallCountdowns">
                                        <template #suffix>
                                            <el-button  size="medium" icon="el-icon-search" @click="getallCountdowns"></el-button>
                                        </template>
                                    </el-input>
                                </div>
                                <div class="fizzy_add_new_actions">
                                    <el-button size="mini"  @click="showAddFormModal = true" type="primary" icon="el-icon-circle-plus">
                                        Add Countdown
                                    </el-button>
                                </div>
                            </div>
                            <el-table
                                :data="allCountdowns"
                                @selection-change="handleSelectionChange"
                                style="width: 100%"
                            >
                                <el-table-column
                                type="selection"
                                width="55">
                                </el-table-column>

                                <el-table-column type="expand">
                                <template #default="props">
                                    <p>Title: {{ props.row.post_title }}</p>
                                </template>
                                </el-table-column>

                                <el-table-column
                                label="Name"
                                width="400"
                                >
                                <template #default="scope">
                                    <strong>{{ scope.row.post_title }}</strong>
                                    <div class="row-actions fizzy_row_actions">
                                        <router-link :to="'/countdown-editor/'+scope.row.ID">
                                            Edit
                                        </router-link>
                                        |
                                        <a @click="confirmDeleteCountdown(scope.row)" class="delete_btn">Delete</a>
                                        |
                                        <a @click.prevent="duplicateCountdown(scope.row)">Duplicate</a>
                                    </div>
                                </template>
                                </el-table-column>

                                <el-table-column 
                                label="Type"
                                prop="post_content"
                                >
                                
                                </el-table-column>

                                <el-table-column
                                    label="Short Code"
                                    width="350"
                                >
                                <template #default="scope">
                                    <code class="copy"
                                        :data-clipboard-text='`[ninja_countdown_layout id="${scope.row.ID}" ]`'>
                                        <i class="el-icon-document"></i> [ninja_countdown_layout id="{{ scope.row.ID }}"]
                                    </code>
                                </template>
                                </el-table-column>
                            </el-table>
                        </div>

                        <div class="fizzy_pagination">
                            <el-pagination
                                background
                                @size-change="handleSizeChange"
                                @current-change="handleCurrentChange"
                                :current-page="page_number"
                                :page-size="per_page"
                                :page-sizes="pageSizes"
                                layout="total, sizes, prev, pager, next"
                                :total="total">
                            </el-pagination>
                        </div>
                    </div>
                </el-col>
            </el-row>

            <!--Delete form Confimation Modal-->
            <el-dialog
                    title="Are You Sure, You want to delete this Countdown?"
                    v-model="deleteDialogVisible"
                    :before-close="handleDeleteClose"
                    width="60%">
                <div class="modal_body">
                    <p>All the data assoscilate with this countdown will be deleted</p>
                    <p>You are deleting countdown id: <b>{{ deletingCountdown.ID }}</b>. <br/>Countdown Title: <b>{{
                        deletingCountdown.post_title }}</b></p>
                </div>
                <template #footer>
                    <span class="dialog-footer">
                        <el-button @click="deleteDialogVisible = false">Cancel</el-button>
                        <el-button type="primary" @click="deleteCountdownNow()">Confirm</el-button>
                    </span>
                </template>
            </el-dialog>
        </div>
    </div>
</template>

<style lang="scss">
    .fizzy_all_countdowns{
        .el-input__suffix{
            right: 0px !important;
        }
        .fizzy_pagination{
            float:right;
            margin:15px 0px;
            .el-input__inner{
                background-color: #fff;
            }
        }
        .ninja_countdown_table{
            .fizzy_table_actions{
                display: flex;
                margin:15px 0px;
                align-items: center;
                justify-content: space-between;
                .nina_search_action{
                    display:flex;
                }
            }
        }
        .fizzy_row_actions{
            a{
                text-decoration: none;
                cursor:pointer;
                &.delete_btn{
                   color:#ff0000; 
                }
            } 
        }
    }
</style>

<script type="text/babel">
import predefinedCountdowns from '../components/modals/predefinedCountdowns.vue';
import Welcome from './editor-ui/pieces/Welcome.vue';

export default {
    components:{
        predefinedCountdowns,
        Welcome
    },
    data() {
        return {
            showAddFormModal: false,
            loading: false,
            allCountdowns: [],
            multipleSelection: [],
            deletingCountdown: {},
            deleteDialogVisible: false,
            //pagination
            per_page: 5,
            page_number: 1,
            total: 0,
            pageSizes: [5,10, 20, 30, 40, 50],
            search_string: '',
        }
    },
    methods: {
        //multiple select
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
        //pagination
        handleSizeChange(val) {
            this.per_page = val;
            this.getallCountdowns();
        },
        handleCurrentChange(val) {
            this.page_number = val;
            this.getallCountdowns();
        },
        getallCountdowns(){
            this.loading = true
            this.$adminGet({
                route: 'get_all_countdowns',
                per_page: this.per_page,
                page_number: this.page_number,
                search_string: this.search_string
            })
                .then(response => {
                    if( response.data ) {
                        this.allCountdowns = response.data.allCountdowns
                        //pagination
                        this.total = response.data.total
                    }
                }).fail(error => {

                }).always(() => {
                    this.loading = false
                });
        },
        confirmDeleteCountdown(countdown) {
            this.deletingCountdown = countdown;
            this.deleteDialogVisible = true;
        },
        deleteCountdownNow(){
            this.loading = true;
            this.$adminPost({
                route: 'delete_countdown',
                countdown_id: this.deletingCountdown.ID
            })
                .then(response => {
                    if( response.data ) {
                        this.$message({
                            showClose: true,
                            message: response.data.message,
                            type: 'success'
                        });
                        this.getallCountdowns();
                    }
                }).fail(error => {

                }).always(() => {
                    this.deleteDialogVisible = false;
                    this.deletingCountdown = {}
                    this.loading = false;
                });
        },
        handleDeleteClose(){
            this.deleteDialogVisible = false;
            this.deletingCountdown = {}
        },
        duplicateCountdown(countdown){
            this.loading = true;
            this.$adminPost({
                route: 'duplicate_countdown',
                countdown_id: countdown.ID
            })
                .then(response => {
                    if( response.data ) {
                        this.$message({
                            showClose: true,
                            message: response.data.message,
                            type: 'success'
                        });
                        let countdownId = response.data.countdown_id
                        this.$router.push('/countdown-editor/'+countdownId)
                    }
                }).fail((error) => {

                }).always(() => {
                    this.loading = false;
                });
        }
    },
    mounted(){
        this.getallCountdowns()
    }
}
</script>