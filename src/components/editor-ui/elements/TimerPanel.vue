<template>
    <div>

        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">REMAINING TIME PERIOD</label>
                    <el-input-number v-model="num" size="mini" @change="handleChange" :min="1" :max="10"></el-input-number>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">SET THE TIME IN</label>
                    <el-select v-model="val" clearable placeholder="Select" size="mini">
                        <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                        </el-option>
                    </el-select>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">POSITION</label>
                    <el-radio-group v-model="radio">
                        <el-radio :label="3">Option A</el-radio>
                        <el-radio :label="6">Option B</el-radio>
                        <el-radio :label="9">Option C</el-radio>
                    </el-radio-group>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">MESSAGE BEFORE TIMER</label>
                    <el-input type="text" v-model="val"></el-input>
                </div>
            </el-col>
        </el-row>

    </div>
</template>

<style lang="scss">
    .ninja_countdown_item {
        margin:10px 5px;
        color:#fff;
        .ninja_countdown_label {
            display: block;
            margin-bottom: 8px;
        }
        .el-input__inner {
            color: #fff !important;
            background: #303131 !important;
            &:focus {
                color: #fff;
                box-shadow:none;
                outline:none;
            }
        }
        .el-input-number__decrease,.el-input-number__increase{
            background: #303131 !important;
            &:hover {
                color: #fff;
                box-shadow:none;
                outline:none;
            }
        }
   
    }
</style>

<script>
export default {
    data() {
        return {
            num:1,
            val:'',
            radio:'',
            activeName: "1",
            value1:'',
            options: [{
                value: 'Option1',
                label: 'Option1'
                }, {
                value: 'Option2',
                label: 'Option2'
                }, {
                value: 'Option3',
                label: 'Option3'
            }],
        }
    },
    methods: {
      handleChange(value) {
        console.log(value)
      }
    }
}
</script>