import './index.css';
import './app.css';
import LeftPanel from './layouts/LeftPanel/LeftPanel.jsx';
import Body from './layouts/Body/Body.jsx';
import Header from './components/Header/Header.jsx';
import JournalList from './components/JournalList/JournalList.jsx';
import JournalAddButton from './components/JournalAddButton/JournalAddButton.jsx';
import JournalForm from './components/JournalForm/JournalForm.jsx';
import {useLocalStorage} from './hooks/useLocalStorage.js';
import {UserContextProvider} from './context/user.context.jsx';
import {useState} from 'react';

function mapItems(items) {
	if (!items) {
		return [];
	}

	return items.map(i => ({
		...i,
		date: new Date(i.date)
	}));
}

export default function App () {
	const [items, setItems] = useLocalStorage('data');
	const [selectedItem, setSelectedItem] = useState(null);

	console.log(items);
	const addItem = (item) => {
		if (!item.id) {
			setItems([...mapItems(items), {
				...item,
				date: new Date(item.date),
				id: items.length > 0 ? Math.max(...items.map(i => i.id)) + 1 : 1
			}]);
		} else {
			setItems([...mapItems(items).map(i => {
				if (i.id === item.id) {
					return {
						...item
					};
				}
				return i;
			})]);
		}
	};

	const deleteItem = (id) => {
		setItems([...items.filter(i => i.id !== id)]);
	};

	console.log(selectedItem);

	return (
		<UserContextProvider>
			<div className='app'>
				<LeftPanel>
					<Header/>
					<JournalAddButton clearForm={() => setSelectedItem(null)}/>
					<JournalList items={mapItems(items)} setItem={setSelectedItem}/>
				</LeftPanel>
				<Body>
					<JournalForm onSubmit={addItem} data={selectedItem} onDelete={deleteItem}/>
				</Body>
			</div>
		</UserContextProvider>
	);
}