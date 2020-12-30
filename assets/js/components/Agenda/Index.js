import DateFilter from './DateFilter';
import Events from './Events';
import Top from './Top';

const {
    useState,
    useEffect
} = wp.element;

function Index() {
    const [ isLoading, setIsLoading ] = useState( false );
    const [ currentDay, setCurrentDay ] = useState( new Date().getDate() );
    const [ currentMonth, setCurrentMonth ] = useState( new Date().getMonth() + 1 );
    const [ currentYear, setCurrentYear ] = useState( new Date().getYear() );
    const [ dateFilter, setDateFilter ] = useState( [] );
    const [ dateFilterId, setDateFilterId ] = useState();
    const [ isBetweenDate, setIsBetweenDate ] = useState();
    const [ events, setEvents ] = useState( [] );
    const [ filteredEvents, setFilteredEvents ] = useState( [] );

    return (
        <>
            <DateFilter
                dateFilter={dateFilter}
                setDateFilter={setDateFilter}
                setDateFilterId={setDateFilterId}
                currentDay={currentDay}
                currentMonth={currentMonth}
                currentYear={currentYear}
                setIsBetweenDate={setIsBetweenDate}
            />
            <Events
                isLoading={isLoading}
                setIsLoading={setIsLoading}
                dateFilter={dateFilter}
                dateFilterId={dateFilterId}
                events={events}
                setEvents={setEvents}
                filteredEvents={filteredEvents}
                setFilteredEvents={setFilteredEvents}
                isBetweenDate={isBetweenDate}
            />
        </>
    );
}

export default Index;
