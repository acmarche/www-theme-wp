import DateFilter from './DateFilter';
import Events from './Events';
import Top from './Top';

const { useState, useEffect } = wp.element;

function Index() {
    const [ isLoading, setIsLoading ] = useState( false );
    const [ currentDay, setCurrentDay ] = useState( new Date().getDate() );
    const [ currentMonth, setCurrentMonth ] = useState( new Date().getMonth() + 1 );
    const [ currentYear, setCurrentYear ] = useState( new Date().getYear() );
    const [ dateFilter, setDateFilter ] = useState([]);
    const [ dateFilterId, setDateFilterId ] = useState();
    const [ isBetweenDate, setIsBetweenDate ] = useState();
    const [ events, setEvents ] = useState([]);
    const [ filteredEvents, setFilteredEvents ] = useState([]);

    return (
        <>
            <section
                id="content"
                className="pt-42px pb-36px pl-ls-42px overflow-ls-hidden overflow-md-hidden pl-ls-lg-0 pt-xl-66px pb-lg-66px mw-1440px mx-xl-auto w-100"
            >
                <div className="bg-white pt-24px px-24px position-relative d-md-flex px-xl-48px mx-xl-n30px justify-content-md-center flex-column">
                    <Top />

                    <div className="px-0 d-md-flex flex-md-column d-ls-md-flex flex-ls-md-column pt-48px align-items-center">
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
                    </div>
                </div>
            </section>
        </>
    );
}

export default Index;
