$.fn.dataTableExt.oApi.fnFakeRowspan = function (oSettings) {
    _.each(oSettings.aoData, function(oData) {
      var cellsToRemove = [];
      for (var iColumn = 0; iColumn < oData.nTr.childNodes.length; iColumn++) {
        var cell = oData.nTr.childNodes[iColumn];
        var rowspan = $(cell).data('rowspan');
        var hide = $(cell).data('hide');

        if (hide) {
          cellsToRemove.push(cell);
        } else if (rowspan > 1) {
          cell.rowSpan = rowspan;
        }
      }
      // Remove the cells at the end, so you're not editing the current array
      _.each(cellsToRemove, function(cell) {
        oData.nTr.removeChild(cell);
      });
    });

    oSettings.aoDrawCallback.push({ "sName": "fnFakeRowspan" });
      
    return this;
};