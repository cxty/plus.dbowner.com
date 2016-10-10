/**
 * wbqing405@sina.com
 * 
 * 数据统计
 */
function TwebStaticsPlugIn(){
	this.JS_LANG = '';
	this.udata = '';
}
TwebStaticsPlugIn.prototype.init = function(){
	webStaticsPlugIn.hightchart();
	//alert(webStatics.udata.count);
	
};
TwebStaticsPlugIn.prototype.hightchart = function(){
	$('#container').highcharts({
    	//配置chart选项
        chart: {
            renderTo: 'highcharts1',  //容器名，和body部分的div id要一致
            type: 'spline'            //图表类型，这里选择折线图
        },
        //配置链接及名称选项 
        credits: {
            enabled : true,
            href : webStaticsPlugIn.udata.site_href,
            text : webStaticsPlugIn.udata.site_text
        },
        //配置标题
        title: {
            text: webStaticsPlugIn.udata.webName + ' ' + webStaticsPlugIn.udata.datetime + ' ' + webStaticsPlugIn.JS_LANG.AccessStatistics,
            y:10  //默认对齐是顶部，所以这里代表距离顶部10px 
        },
        //配置副标题
        subtitle: {
            text: webStaticsPlugIn.JS_LANG.DataSources,
            y:30
        },
        //配置x轴
        xAxis: {
        	min: 0, 
            categories: ['0', '1', '2', '3', '4', '5','6', '7', '8', '9', '10', '11','12','13','14','15','16','17','18','19','20','21','22','23/' + webStaticsPlugIn.JS_LANG.Dot]
        },
        // 配置y轴
        yAxis: {
            title: {
                text: webStaticsPlugIn.JS_LANG.UnitPercentTime
            },
            min: 0, 
            labels: {   
                formatter: function() {
                    return this.value + webStaticsPlugIn.JS_LANG.UnitTime
                }
            }
        },
        //配置数据点提示框
        tooltip: {
            crosshairs: true,
        },
        //配置数据列 
        series: 
        	[{
	            name: webStaticsPlugIn.JS_LANG.BrowseTime,
	            marker: {
	                symbol: 'square'
	            },
	            data: webStaticsPlugIn.udata.pvArr
            },{
	            name: webStaticsPlugIn.JS_LANG.IPTime,
	            marker: {
	                symbol: 'diamond'
	            },
	            data: webStaticsPlugIn.udata.ipArr
            }]
    });
};