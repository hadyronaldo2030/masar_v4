// ============================= Charts.js ==================================
const xValues = ["Item1", "Item2", "Item3", "Item4", "Item5", "Item6", "Item7", "Item8", "Item9"];
const yValues = [46, 11, 23, 4, 52, 66, 47, 81, 89, 10, 91, 32];
const barColors = ["rgb(255 128 0 / 87%)", "rgba(0,0,255,0.5)","rgb(255 128 0 / 87%)","rgba(0,0,255,0.5)","rgb(255 128 0 / 87%)", "rgba(0,0,255,0.5)","rgb(255 128 0 / 87%)","rgb(0,0,255,0.5)", "rgba(255 128 0 / 87%)"];

new Chart("ChartBar", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Revenue percentage per month"
    }
  }
});
//
const xValue = [];
const yValue = [];
generateData("Math.sin(x)", 0, 10, 0.5);

new Chart("ChartLine", {
  type: "line",
  data: {
    labels: xValue,
    datasets: [{
      fill: false,
      pointRadius: 2,
      borderColor: "rgba(0,0,255,0.5)",
      data: yValue
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Revenue percentage per month",
      fontSize: 16
    }
  }
});
function generateData(value, i1, i2, step = 1) {
  for (let x = i1; x <= i2; x += step) {
    yValue.push(eval(value));
    xValue.push(x);
  }
}


//


