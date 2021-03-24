<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">SHOW BUTTON</label>
                    <el-switch
                    v-model="button_configs.show_button"
                    active-value="true"
                    inactive-value="false"
                    active-color="#13ce66">
                    </el-switch>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="button_configs.show_button === 'true'">
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">BUTTON LINK</label>
                    <el-input type="text" size="mini" v-model="button_configs.button_link"></el-input>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="button_configs.show_button === 'true'">
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">BUTTON Text</label>
                    <el-input type="text" size="mini" v-model="button_configs.button_text"></el-input>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="button_configs.show_button === 'true'">
            <el-col :span="24">
                <div class="ninja_countdown_item">
                    <label class="ninja_countdown_label">OPEN THE LINK IN A NEW BROWSER TAB</label>
                    <el-switch
                    v-model="button_configs.new_tab"
                    active-value="true"
                    inactive-value="false"
                    active-color="#13ce66">
                    </el-switch>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
export default {
    props:['button_configs'],
    data() {
        return {
            val:'',
            value2:"true",
            activeName: "1"
        }
    }
}
</script>