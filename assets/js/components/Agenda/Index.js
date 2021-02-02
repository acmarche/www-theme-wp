import DateFilter from './DateFilter';
import Events from './Events';

const {
    useState,
    useEffect
} = wp.element;

function App() {
    const [ isLoading, setIsLoading ] = useState( true );
    const [ currentMonth, setCurrentMonth ] = useState( new Date().getMonth() + 1 ); // 0 based
    const [ currentYear, setCurrentYear ] = useState( new Date().getYear() );
    const [ dateSelector, setDateSelector ] = useState([]);
    const [ dateSelectorValues, setDateSelectorValues ] = useState();
    const [ events, setEvents ] = useState([]);
    const [ filteredEvents, setFilteredEvents ] = useState([]);

    return (
        <>
            <DateFilter
                dateSelector={dateSelector}
                setDateSelector={setDateSelector}
                setDateSelectorValues={setDateSelectorValues}
                currentMonth={currentMonth}
                currentYear={currentYear}
            />
            <Events
                isLoading={isLoading}
                setIsLoading={setIsLoading}
                dateSelectorValues={dateSelectorValues}
                events={events}
                setEvents={setEvents}
                filteredEvents={filteredEvents}
                setFilteredEvents={setFilteredEvents}
            />
        </>
    );
}

export default App;
