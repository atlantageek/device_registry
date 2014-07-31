var whtSpEnds = new RegExp("^\\s*|\\s*$","g");
var whtSpMult = new RegExp("^\\s\\s+$","g");
var rowSelected=null;
var oldClass=null;
var oldColumn=null;
var cmpOrder=1;

if (document.ELEMENT_NODE == null) {
  document.ELEMENT_NODE = 1;
  document.TEXT_NODE = 3;
}
function getTextValue(el)
{
   var i;
   var s;
   s="";
      for (i=0; i<el.childNodes.length; i++)
      {
         if (el.childNodes[i].nodeType == document.TEXT_NODE)
         {
            s += el.childNodes[i].nodeValue;
         }
         else if (el.childNodes[i].nodeType == document.ELEMENT_NODE &&
               el.childNodes[i].tagName == "BR")
         {
            s += "_";
         }
	 else 
         {
            s+=getTextValue(el.childNodes[i]);
         }
      }
   return normalizeString(s);
}
function normalizeString(s)
{
   s=s.replace(whtSpMult, " ");
   s=s.replace(whtSpEnds, "");
   return s;

}
function compareValues(v1, v2)
{
   var f1, f2;
   //alert("V1="+v1+"V2="+v2);
   f1=parseFloat(v1);
   f2=parseFloat(v2);
   if (!isNaN(f1) && !isNaN(f2)) {
      v1=f1;
      v2=f2;
   }
   if (v1 == v2)
      return 0;
   if (v1 > v2)
      return -1;
   return 1;
}

function sortTable(id,col)
{
   var tblEl=document.getElementById(id);
   var oldDisplay=tblEl.style.display;
   tblEl.style.display="none";
   var tmpEl;
   var i, j;
   var minVal, minIdx;
   var testVal;
   var cmp;

   if (col == oldColumn)
   {
      cmpOrder=cmpOrder*-1;//Reverse Order if same column is sorted again.
   }
   else
   {
      cmpOrder=1; // Default ordering.
   }
   for (i=0;i<tblEl.rows.length-1;i++)
   {
      minIdx = i;
      minVal=getTextValue(tblEl.rows[i].cells[col]);
      for (j=i+1;j<tblEl.rows.length;j++)
      {
         testVal=getTextValue(tblEl.rows[j].cells[col]);
         cmp = compareValues(minVal, testVal) * cmpOrder;
         if (cmp < 0)
         {
            minIdx=j;
            minVal = testVal;
         }
      }
      if (minIdx > i) {
        tmpEl = tblEl.removeChild(tblEl.rows[minIdx]);
        tblEl.insertBefore(tmpEl, tblEl.rows[i]);
      }
   }
   tblEl.style.display=oldDisplay;
   oldColumn=col;
   return false
}

function selectRow(el, targetTableId)
{
   if (rowSelected != null)
   {
      rowSelected.className=oldClass;
   }
   oldClass=el.className;
   el.className="selectedRow";
   rowSelected=el;
   cmts_id=el.id;
   selectedRE = new RegExp("_" + cmts_id+"_","g");
   targetTable=document.getElementById(targetTableId);
   for (i=0;i<targetTable.rows.length;i++)
   {
      row_id=targetTable.rows[i].id;
      if (row_id.match(selectedRE))
      {
         document.getElementById(row_id).style.display='';
      }
      else
      {
         document.getElementById(row_id).style.display='none';
      }
   }
   
}
