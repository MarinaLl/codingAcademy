function contest() {
	let prizeList = ['Sale', 'Free Course', 'Nothing'];
	let i = Math.floor(Math.random() * prizeList.length);
	return prizeList[i];
}