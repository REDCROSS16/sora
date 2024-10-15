import './JournalList.css';
import CardButton from '../CardButton/CardButton.jsx';
import JournalItem from '../JournalItem/JournalItem.jsx';
import React, {useContext} from 'react';
import {UserContext} from '../../context/user.context.jsx';

function JournalList({items}) {

	const {userId} = useContext(UserContext);

	const sortItems = (a, b) => {
		return (a.date > b.date) ? 1 : -1;
	};

	return (
		<div className='journal-list'>
			{ items.length === 0 && <p>Записей нет</p>}
			{ items.length > 0 && items.filter(el => el.userId === userId).sort(sortItems).map(el => (
				<CardButton key={el.id}>
					<JournalItem
						title={el.title}
						date={el.date}
						text={el.text}
					/>
				</CardButton>
			))}
		</div>
	);
}

export default JournalList;