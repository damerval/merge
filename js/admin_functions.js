/**
 * Created by philippe on 10/9/16.
 */

function checkExclusionsDialog() {
  return cewEmployee.val() !== ''
      && cewClient.val() !== ''
      && cewStartDate.val() !== '';
}

function clearExclusionsDialog() {
  cewEmployee.jqxDropDownList('clearSelection');
  cewClient.jqxDropDownList('clearSelection');
  cewStartDate.jqxDateTimeInput({ value: new Date() });
  cewEndDate.jqxDateTimeInput({ value: null });
}

function loadExclusionsDialog(employeeId, clientId, startDate, endDate) {
  cewEmployee.jqxDropDownList('selectItem', cewEmployee.jqxDropDownList('getItemByValue', employeeId));
  cewClient.jqxDropDownList('selectItem', cewClient.jqxDropDownList('getItemByValue', clientId));
  cewStartDate.jqxDateTimeInput('setDate', startDate);
  cewEndDate.jqxDateTimeInput('setDate', endDate);
}