import './JournalAddButton.css';
import CardButton from '../CardButton/CardButton.jsx';

function JournalAddButton({clearForm}) {

	return (
		<CardButton className="journal-add" onClick={clearForm}>
            + New
		</CardButton>
	);
}

export default JournalAddButton;