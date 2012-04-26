/* 
 *  @author		Vladimir Kopot
 *  @email		vovakop@gmail.com
 *  @copyright	2012
 *  @license	GNU/GPL
 *  @description
 */

Ext.define('bb_cpanel.view.statistic.graphics.users_lines', {
    extend: 'Ext.container.Container',
    alias : 'widget.gUsersLines',
    layout: 'fit',
    items: [{
        xtype: 'chart',
        animate: true,
        store: 'statistic.graph-store',
        insetPadding: 30,
        axes: [{
            type: 'Numeric',
            minimum: 0,
            position: 'left',
            fields: ['traffic'],
            title: false,
            grid: true,
            label: {
                renderer: Ext.util.Format.numberRenderer('0,0'),
                font: '10px Arial'
            }
        }, {
            type: 'Category',
            position: 'bottom',
            fields: ['hour'],
            title: false,
            label: {
                font: '11px Arial',
                renderer: function(name) {
                    return name;
                }
            }
        }],
        series: [{
            type: 'line',
            axis: 'left',
            xField: 'hour',
            yField: 'traffic',
            markerConfig: {
                type: 'circle',
                size: 4,
                radius: 4,
                'stroke-width': 0,
                fill: '#38B8BF',
                stroke: '#38B8BF'
            }
        }]
    }]

});