function ShowFormDataEntries(formData) {
  // Display the key/value pairs
  for (var pair of formData.entries()) {
      console.log(pair[0]+ ': ' + pair[1]); 
  }
}