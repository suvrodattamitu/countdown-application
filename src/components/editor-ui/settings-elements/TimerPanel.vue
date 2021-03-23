<template>
    <div>

        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">REMAINING TIME PERIOD</label>
                    <el-input-number v-model="timer_configs.time_period" size="mini" :min="1" :max="10"></el-input-number>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">SET THE TIME IN</label>
                    <el-select v-model="timer_configs.time_unit" clearable placeholder="Select" size="mini">
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
                    <label class="ninja_countdown_label">MESSAGE BEFORE TIMER</label>
                    <el-input type="text" v-model="timer_configs.message"></el-input>
                </div>
            </el-col>
        </el-row>

    </div>
</template>

<script>
export default {
    props:['timer_configs'],
    data() {
        return {
            num:1,
            val:'',
            radio:'',
            activeName: "1",
            value1:'',
            options: [{
                value: 'days',
                label: 'Days'
                }, {
                value: 'hours',
                label: 'Hours'
                }, {
                value: 'minutes',
                label: 'Minutes'
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