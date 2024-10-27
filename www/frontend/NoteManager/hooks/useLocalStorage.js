import {useState, useEffect} from 'react';

export const useLocalStorage = (key) => {
	const [data, setData] = useState();

	// читаем из локалсторадж
	useEffect(() => {
		const res = JSON.parse(localStorage.getItem(key));

		if (res) {
			setData(res);
		}
	}, []);

	// записываем в локалсторадж
	const saveData = (newData) => {
		localStorage.setItem(key, JSON.stringify(newData));
		setData(newData);
	};

	return [data, saveData];
};