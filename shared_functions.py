import sqlite3

# Create SQLiteDB if doesn't exist: 
def CreateSQLiteDB(filepath):
    with sqlite3.connect(filepath) as conn:
        # Perform database operations here
        cursor = conn.cursor()
        cursor.execute('SELECT SQLITE_VERSION()')
        data = cursor.fetchone()
        #print('SQLite version:', data)
        conn.close()


# Alter Table / Add Columns In SQLite: 
def Sqlite_AlterTableAddColumn(dbfile, table,column, columntype):
    # Connect to the database
    conn = sqlite3.connect(dbfile)
    cursor = conn.cursor()
    
    # Execute the ALTER TABLE statement to add a new column
    cursor.execute(f"ALTER TABLE {table} ADD COLUMN {column} {columntype}")
    
    # Commit the changes and close the connection
    conn.commit()
    conn.close()


# SelectQuery from SQLite DB: 
def retrieve_query_results(db_file, query):
    conn = sqlite3.connect(db_file)
    cur = conn.cursor()
    cur.execute(query)
    rows = cur.fetchall()
    conn.close()
    return rows


# Insert/ExecuteNonQuery In SQLite DB: 
def ExecuteNonQuery(dbfile,sql):
    # Connect to the database
    conn = sqlite3.connect(dbfile)
    cursor = conn.cursor()
    
    # Execute the ALTER TABLE statement to add a new column
    cursor.execute(sql)
    
    # Commit the changes and close the connection
    conn.commit()
    conn.close()

